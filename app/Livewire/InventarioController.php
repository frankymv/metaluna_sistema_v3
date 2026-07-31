<?php

namespace App\Livewire;
use Illuminate\Support\Str;

use App\Models\Disenio;
use App\Models\Marca;
use App\Models\Material;
use App\Models\Producto;
use App\Models\Tipo;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;

use Carbon\Carbon;

class InventarioController extends Component
{
    use LivewireAlert;
    use WithPagination;
    //


    public $existencia, $estado=1,$created_at,$updated_at, $producto_id;

    //
    public $title='Inventario';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $isDelete = false;
    public $inventario;

    public $tipo, $marca, $disenio, $material;
    public $dataa;
    protected $productos=[];
    public $marcas=[];
    public $tipos=[];
    public $materiales=[];
    public $disenios=[];
    public $producto_sucursal=[];
    public $nombre, $descripcion, $calibre,$disabled;
    public $sucursal_asignada;


    /////////filtros
    public $filtroCodigoProducto=null;
    public $filtroNombreProducto=null;
    public $filtroTipo=null;
    Public $filtroMarca=null;
    Public $filtroDisenio=null;
    Public $filtroMaterial=null;
    Public $paginas=['5','10','15','20','25','Todo'];



    protected $rules = [
        'nombre' => 'required',
    ];

protected $listeners=['create','edit', 'delete','show','exportarFila'];

  public $campos=['nombre','descripcion','calibre'];


    public function render()
    {

        $this->tipos=Tipo::all();
        $this->marcas=Marca::all();
        $this->disenios=Disenio::all();
        $this->materiales=Material::all();

        $temp_data=Producto::with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')
        ->where('codigo','LIKE',"%{$this->filtroCodigoProducto}%")
        ->where('nombre','LIKE',"%{$this->filtroNombreProducto}%")
        ->whereRelation('marca','id','LIKE',"%{$this->filtroMarca}%")
        ->whereRelation('tipo','id','LIKE',"%{$this->filtroTipo}%")
        ->whereRelation('disenio','id','LIKE',"%{$this->filtroDisenio}%")
        ->whereRelation('material','id','LIKE',"%{$this->filtroMaterial}%")
        ->paginate($this->per_page);


        return view('livewire.pages.inventario.index',['productos'=>$temp_data]);

    }


    public function borrarFiltros()
    {
        $this->reset();
    }

      public function edit($rowId){
        $data=Producto::where('id', $rowId)->with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')->first();
        $this->nombre = $data->nombre;
        $this->existencia = $data->existencia;
        $this->tipo = $data->tipo->nombre;
        $this->marca = $data->marca->nombre;
        $this->disenio = $data->disenio->nombre;
        $this->material = $data->material->nombre;
        $this->disabled=true;
        $this->isShow=true;
    }




    public function show($rowId){
        $this->disabled=true;
        $this->inventario=Producto::where('id', $rowId)->with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')->first();

        //dd($data);
        $this->nombre = $this->inventario->nombre;
        $this->existencia = $this->inventario->existencia;
        $this->tipo = $this->inventario->tipo->nombre;
        $this->marca = $this->inventario->marca->nombre;
        $this->disenio = $this->inventario->disenio->nombre;
        $this->material = $this->inventario->material->nombre;
        $this->disabled=true;
        $this->isShow=true;
    }






    public function exportarGeneral()
    {
        $temp_data=Producto::with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')
        ->where('codigo','LIKE',"%{$this->filtroCodigoProducto}%")
        ->where('nombre','LIKE',"%{$this->filtroNombreProducto}%")
        ->whereRelation('marca','id','LIKE',"%{$this->filtroMarca}%")
        ->whereRelation('tipo','id','LIKE',"%{$this->filtroTipo}%")
        ->whereRelation('disenio','id','LIKE',"%{$this->filtroDisenio}%")
        ->whereRelation('material','id','LIKE',"%{$this->filtroMaterial}%")
        ->paginate($this->per_page);

        $data=exportarGeneralPDF('Inventario', [
            'productos' => $temp_data
        ]);
        return $data;
    }

    public function exportarFilaa($id)
    {
         $temp=Producto::where('id', $id)->with('marca')->with('material')->with('tipo')->with('disenio')->with('sucursales')->first();

         $data=exportarFilaPDF('Inventario', [
            'data' => $temp,
        ]);
        return $data;
    }

       public function exportarFila($rowId)
    {
        $data_temp=Producto::find($rowId);
         $data=exportarFilaPDF('Inventario', [
            'data' => $data_temp,
        ]);
        return $data;
    }



    public function cancel(){
        $this->dispatch('pg:eventRefresh-');        $this->resetInputFields();
        $this->resetValidation();
    }


    private function resetInputFields(){

        $this->reset($this->campos);
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////

        ////////////////////
    }







}
