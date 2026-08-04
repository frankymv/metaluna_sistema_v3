<?php

namespace App\Livewire;
use Illuminate\Support\Str;

use App\Constantes\UnidadMedida;
use App\Models\Disenio;
use App\Models\Marca;
use App\Models\Material;
use App\Models\Producto;
use App\Models\Tipo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;

class ProductoController extends Component
{
    use WithPagination;
    use LivewireAlert;


    //
    public $codigo='', $nombre='',$nombre_venta='', $descripcion='', $disabled=false,$disabledButton=false,$calibre=null,   $divisible=false, $marca_id, $tipo_id, $material_id, $disenio_id,  $estado=true,$created_at,$updated_at;
    public $disabledCodigo=false, $disabledNombre=false,$disabledTipo=false, $disabledGenerar=false, $disabledNombreVenta=false;
    public $disabledDisenio=false,$disabledMarca=false, $disabledMaterial=false, $disabledLongitud=false, $disabledPeso=false, $disabledDiametro=false;

    public $longitudes=null;
    public $pesos=null;
    public $diametros=null;

    public $longitud=0;
    public $tipo_longitud=null;
    public $peso=0;
    public $tipo_peso=null;
    public $diametro=0;
    public $tipo_diametro=null;



    public $marcas, $tipos, $materiales, $disenios;
    //
    public $title='Producto';
    public $data=null, $per_page=10, $id_data=null, $id_last=null;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $isDelete = false;

    public $precio_unitario=0;
    public $precio_final=0;

    public $delete_no=null, $delete_nombre=null;

    public $precio_total_venta_producto=0;


protected $listeners=['create','edit', 'delete','show','exportarFila'];

    /////////filtros
    public $filtroCodigoProducto=null;
    public $filtroNombreProducto=null;
    public $filtroTipo=null;
    Public $filtroMarca=null;
    Public $filtroDisenio=null;
    Public $filtroMaterial=null;

    public $filtroFecha=null;
    public $filtroFechaInicio=null;
    public $filtroFechaFin=null;
    public $paginas=['5','10','15','20','25','Todo'];

    public $usa_calibre = false;
    public $usa_longitud = false;
    public $usa_peso = false;
    public $usa_diametro = false;





    public function updatedTipoLongitud($id){
        $this->longitud=0;
    }

    public function updatedPrecioVentaProducto($value){
        if ($this->tipo_id==9 && $this->tipo_longitud=="pie" ) {
            $this->precio_total_venta_producto= $value*$this->longitud;
        }else{
            $this->precio_total_venta_producto= $value;
        }
    }

    public function render()
    {
       
        return view('livewire.pages.producto.index');
    }




public function create()
{
    $this->longitudes = UnidadMedida::$longitud;
    $this->pesos = UnidadMedida::$peso;
    $this->diametros = UnidadMedida::$diametro;
    $this->marcas = Marca::where('estado',1)->get();
    $this->tipos = Tipo::where('estado',1)->get();
    $this->materiales = Material::where('estado',1)->get();
    $this->disenios = Disenio::where('estado',1)->get();
    $this->isCreate = true;

    // 🔥 Auto-generar si ya hay tipo seleccionado
    $this->regenerarCodigoYNombre();
}

private function regenerarCodigoYNombre()
{
    if (!$this->tipo_id) {
        $this->codigo = '';
        $this->nombre = '';
        return;
    }
    $tipo = Tipo::find($this->tipo_id);
    if (!$tipo) return;
    // correlativo simple (puedes cambiarlo)
    $ultimo = Producto::latest('id')->first();
    $nuevoId = $ultimo ? ($ultimo->id + 1) : 1;
    $this->codigo = strtoupper(substr($tipo->nombre, 0, 3)) . $nuevoId;
    $partes = [];
    $partes[] = $tipo->nombre;

    if ($this->material_id) $partes[] = Material::find($this->material_id)?->nombre;
    if ($this->marca_id) $partes[] = Marca::find($this->marca_id)?->nombre;
    if ($this->disenio_id) $partes[] = Disenio::find($this->disenio_id)?->nombre;

    if ($this->usa_calibre && $this->calibre !== null && $this->calibre !== '') {
        $partes[] = "Calibre: {$this->calibre}";
    }

    if ($this->usa_longitud && $this->longitud && $this->tipo_longitud) {
        $unidad = $this->longitudes[$this->tipo_longitud] ?? '';
        $partes[] = "Longitud: {$this->longitud} {$unidad}";
    }

    if ($this->usa_peso && $this->peso && $this->tipo_peso) {
        $unidad = $this->pesos[$this->tipo_peso] ?? '';
        $partes[] = "Peso: {$this->peso} {$unidad}";
    }

    if ($this->usa_diametro && $this->diametro && $this->tipo_diametro) {
        $unidad = $this->diametros[$this->tipo_diametro] ?? '';
        $partes[] = "Diametro: {$this->diametro} {$unidad}";
    }

    $this->nombre = trim(implode(' ', array_filter($partes)));
    $this->nombre_venta=$this->nombre_venta;
}

private function recalcularPrecioTotal()
{
    if ($this->tipo_id == 9 && $this->tipo_longitud == "pie" && $this->usa_longitud) {
        $this->precio_final = (float)$this->precio_unitario * (float)$this->longitud;
    } else {
          // dd("aca en precio");
        $this->precio_final = (float)$this->precio_unitario;
    }
}



public function updated($propertyName)
{

    $campos = [
        'tipo_id',
        'marca_id',
        'material_id',
        'disenio_id',

        'usa_calibre',
        'calibre',

        'usa_longitud',
        'tipo_longitud',
        'longitud',

        'usa_peso',
        'tipo_peso',
        'peso',

        'usa_diametro',
        'tipo_diametro',
        'diametro',

        'precio_unitario'
    ];

    // limpiar cuando se apaga toggle
    if ($propertyName === 'usa_calibre' && !$this->usa_calibre) {

        $this->calibre = null;
    }

    if ($propertyName === 'usa_longitud' && !$this->usa_longitud) {
        $this->tipo_longitud = null;
        $this->longitud = 0;
    }

    if ($propertyName === 'usa_peso' && !$this->usa_peso) {
        $this->tipo_peso = null;
        $this->peso = 0;
    }

    if ($propertyName === 'usa_diametro' && !$this->usa_diametro) {
        $this->tipo_diametro = null;
        $this->diametro = 0;
    }

    // regenerar si cambia algo importante
    if (in_array($propertyName, $campos)) {
        $this->regenerarCodigoYNombre();
        $this->recalcularPrecioTotal();
    }



}





public function store()
{



  
    $this->validate(
[
        'tipo_id' => 'required',
        'precio_unitario' => 'required|numeric|min:0',
]
    );

    if ($this->usa_calibre) {
        $rules['calibre'] = 'required';
    }

    if ($this->usa_longitud) {
        $rules['longitud'] = 'required|numeric|min:0.01';
        $rules['tipo_longitud'] = 'required';
    }

    if ($this->usa_peso) {
        $rules['peso'] = 'required|numeric|min:0.01';
        $rules['tipo_peso'] = 'required';
    }

    if ($this->usa_diametro) {
        $rules['diametro'] = 'required|numeric|min:0.01';
        $rules['tipo_diametro'] = 'required';
    }

    //

    // asegurar que siempre esté generado
    $this->regenerarCodigoYNombre();

    Producto::create([
        'codigo' => $this->codigo,
        'nombre' => $this->nombre,
        'nombre_venta' => $this->nombre_venta,
        'descripcion' => $this->descripcion,
        'calibre' => $this->usa_calibre ? $this->calibre : null,
        'longitud' => $this->usa_longitud ? $this->longitud : 0,
        'tipo_longitud' => $this->usa_longitud ? $this->tipo_longitud : null,
        'peso' => $this->usa_peso ? $this->peso : 0,
        'tipo_peso' => $this->usa_peso ? $this->tipo_peso : null,
        'diametro' => $this->usa_diametro ? $this->diametro : 0,
        'tipo_diametro' => $this->usa_diametro ? $this->tipo_diametro : null,
        'divisible' => $this->divisible,
        'estado' => $this->estado,
        'marca_id' => $this->marca_id,
        'tipo_id' => $this->tipo_id,
        'material_id' => $this->material_id,
        'disenio_id' => $this->disenio_id,
        'precio_unitario' => $this->precio_unitario,
        'precio_final' => $this->precio_final,
    ]);

    $this->alertaNotificacion("store");
    $this->cancel();
    }

public function edit($rowId)
{
    // 🔒 Marcar modo edición ANTES de asignar valores
    $this->isEdit = true;
    $this->isCreate = false;
    $this->isShow = false;
    $this->isDelete = false;

    // Cargar catálogos
    $this->longitudes = UnidadMedida::$longitud;
    $this->pesos = UnidadMedida::$peso;
    $this->diametros = UnidadMedida::$diametro;

    $this->marcas = Marca::where('estado', 1)->get();
    $this->tipos = Tipo::where('estado', 1)->get();
    $this->materiales = Material::where('estado', 1)->get();
    $this->disenios = Disenio::where('estado', 1)->get();

    // Obtener producto
    $data = Producto::findOrFail($rowId);

    // Configurar estados de deshabilitado
    $this->disabled = false;
    $this->disabledButton = false;
    $this->disabledCodigo = true;
    $this->disabledNombre = true;
    $this->disabledTipo = false;

    $this->disabledMarca = false;
    $this->disabledMaterial = false;
    $this->disabledDisenio = false;
    $this->disabledLongitud = false;
    $this->disabledPeso = false;
    $this->disabledDiametro = false;

    // ID
    $this->id_data = $data->id;

    // Datos base
    $this->codigo = $data->codigo;
    $this->nombre = $data->nombre;
    $this->nombre_venta = $data->nombre_venta;
    $this->descripcion = $data->descripcion;

    // Flags de uso
    $this->usa_calibre = !is_null($data->calibre);
    $this->usa_longitud = $data->longitud > 0;
    $this->usa_peso = $data->peso > 0;
    $this->usa_diametro = $data->diametro > 0;

    // Medidas
    $this->calibre = $data->calibre;

    $this->longitud = $data->longitud;
    $this->tipo_longitud = $data->tipo_longitud;

    $this->peso = $data->peso;
    $this->tipo_peso = $data->tipo_peso;

    $this->diametro = $data->diametro;
    $this->tipo_diametro = $data->tipo_diametro;

    // Relaciones
    $this->marca_id = $data->marca_id;
    $this->tipo_id = $data->tipo_id;
    $this->material_id = $data->material_id;
    $this->disenio_id = $data->disenio_id;

    // Precios
    $this->precio_unitario = $data->precio_unitario;
    $this->precio_final = $data->precio_final;

    // Estados
    $this->divisible = $data->divisible;
    $this->estado = $data->estado;
}

  public function show($rowId)
{
        // 🔒 Marcar modo edición ANTES de asignar valores
    $this->isEdit = false;
    $this->isCreate = false;
    $this->isShow = true;
    $this->isDelete = false;

    // Cargar catálogos
    $this->longitudes = UnidadMedida::$longitud;
    $this->pesos = UnidadMedida::$peso;
    $this->diametros = UnidadMedida::$diametro;

    $this->marcas = Marca::where('estado', 1)->get();
    $this->tipos = Tipo::where('estado', 1)->get();
    $this->materiales = Material::where('estado', 1)->get();
    $this->disenios = Disenio::where('estado', 1)->get();

    // Obtener producto
    $data = Producto::findOrFail($rowId);

    // Configurar estados de deshabilitado
    $this->disabled = true;
    $this->disabledButton = true;
    $this->disabledCodigo = true;
    $this->disabledNombre = true;
    $this->disabledNombreVenta = true;
    $this->disabledTipo = true;

    $this->disabledMarca = true;
    $this->disabledMaterial = true;
    $this->disabledDisenio = true;
    $this->disabledLongitud = true;
    $this->disabledPeso = true;
    $this->disabledDiametro = true;

    // ID
    $this->id_data = $data->id;

    // Datos base
    $this->codigo = $data->codigo;
    $this->nombre = $data->nombre;
    $this->nombre_venta = $data->nombre_venta;
    $this->descripcion = $data->descripcion;

    // Flags de uso
    $this->usa_calibre = !is_null($data->calibre);
    $this->usa_longitud = $data->longitud > 0;
    $this->usa_peso = $data->peso > 0;
    $this->usa_diametro = $data->diametro > 0;

    // Medidas
    $this->calibre = $data->calibre;

    $this->longitud = $data->longitud;
    $this->tipo_longitud = $data->tipo_longitud;

    $this->peso = $data->peso;
    $this->tipo_peso = $data->tipo_peso;

    $this->diametro = $data->diametro;
    $this->tipo_diametro = $data->tipo_diametro;

    // Relaciones
    $this->marca_id = $data->marca_id;
    $this->tipo_id = $data->tipo_id;
    $this->material_id = $data->material_id;
    $this->disenio_id = $data->disenio_id;

    // Precios
    $this->precio_unitario = $data->precio_unitario;
    $this->precio_final = $data->precio_final;

    // Estados
    $this->divisible = $data->divisible;
    $this->estado = $data->estado;
}


    public function update($rowId){

        $data = Producto::find($rowId);
        $data->update([
        'codigo' => $this->codigo,
        'nombre' => $this->nombre,
        'nombre_venta' => $this->nombre_venta,
        'descripcion' => $this->descripcion,
        'calibre' => $this->usa_calibre ? $this->calibre : null,
        'longitud' => $this->usa_longitud ? $this->longitud : 0,
        'tipo_longitud' => $this->usa_longitud ? $this->tipo_longitud : null,
        'peso' => $this->usa_peso ? $this->peso : 0,
        'tipo_peso' => $this->usa_peso ? $this->tipo_peso : null,
        'diametro' => $this->usa_diametro ? $this->diametro : 0,
        'tipo_diametro' => $this->usa_diametro ? $this->tipo_diametro : null,
        'divisible' => $this->divisible,
        'estado' => $this->estado,
        'marca_id' => $this->marca_id,
        'tipo_id' => $this->tipo_id,
        'material_id' => $this->material_id,
        'disenio_id' => $this->disenio_id,
        'precio_unitario' => $this->precio_unitario,
        'precio_final' => $this->precio_final,
    ]);

        $this->alertaNotificacion("update");
        $this->cancel();
    }

    public function delete($rowId){
        $data = Producto::find($rowId);
        $this->id_data=$data->id;
        $this->delete_no=$data->codigo;
        $this->delete_nombre=$data->nombre;
        $this->isDelete = true;
    }

    public function destroy($rowId){
        $data=Producto::find($rowId);
        try {
            $data->delete();
            $this->alertaNotificacion("destroy");
        } catch (Exception $e) {
            if($e->getCode()=="23000"){
                $this->alertaNotificacion("23000");
            }else{
                $this->alertaNotificacion("error");
            }
        }

        $this->isDelete = false;
        $this->cancel();
    }


    public function exportarGeneral()
    {
        $data_temp=Producto::with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')
        ->where('codigo','LIKE',"%{$this->filtroCodigoProducto}%")
        ->where('nombre','LIKE',"%{$this->filtroNombreProducto}%")
        ->whereRelation('marca','id','LIKE',"%{$this->filtroMarca}%")
        ->whereRelation('tipo','id','LIKE',"%{$this->filtroTipo}%")
        ->whereRelation('disenio','id','LIKE',"%{$this->filtroDisenio}%")
        ->whereRelation('material','id','LIKE',"%{$this->filtroMaterial}%")
        ->paginate($this->per_page);

        $data=exportarGeneralPDF('Producto', [
            'productos' => $data_temp,
        ]);
        return $data;
    }

    public function exportarFilaa($id)
    {
         $dato=Producto::where('id', $id)->with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')->first();
         $data=exportarFilaPDF('Producto', [
            'dato' => $dato,
        ]);
        return $data;
    }


   public function exportarFila($rowId)
    {
        $data_temp=Producto::find($rowId);
         $data=exportarFilaPDF('Producto', [
            'data' => $data_temp,
        ]);
        return $data;
    }





    public function cancel(){
        $this->dispatch('pg:eventRefresh-producto-table-qnfpyy-table');
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function resetInput(){
        $this->reset(['codigo','id_last','nombre','nombre_venta','marca_id','tipo_id','material_id','disenio_id','calibre','peso','longitud','precio_venta_producto']);

        $this->reset([

            'longitud',
            'tipo_longitud',
            'diametro',
            'tipo_diametro',
            'peso',
            'tipo_peso',

        ]);

    }

    private function resetInputFields(){

        $this->reset();
    }

      function alertaNotificacion($tipo){

        if($tipo==="store"){
            $title="Agregar";
            $texto="Registro agregado";
            $alert="success";

        }elseif($tipo==="update"){
            $title="Editar";
            $texto="Registro editado";
            $alert="success";

        }elseif($tipo==="destroy"){
            $title="Borrar";
            $texto="Registro borrado";
            $alert="success";
        }elseif($tipo==="error"){
            $title="Error";
            $texto="No se completo la operación";
            $alert="error";
        }elseif($tipo==="23000"){
            $title="Error";
            $texto="El registro esta asociado a otro registro";
            $alert="error";
        }
        return $this->alert("$alert", "$title", [
            'position' => 'center',
            'timer' => '2000',
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            'text' => "$texto"
        ]);

    }



}
