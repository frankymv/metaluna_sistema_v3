<?php

namespace App\Livewire;
use Illuminate\Support\Str;

use App\Constantes\DataSistema;
use App\Models\Envio;
use App\Models\Ruta;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use Exception;


class EnvioController extends Component
{
    use LivewireAlert;
    use WithPagination;
    use LivewireAlert;
    public $title='Envio';
    public $data, $per_page=10,  $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isFinalizar=false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false,$disabled_observaciones_inicio_envio=false,$disabled_observaciones_final_envio=false;
    public $rutas=[], $municipios=[],$ventas=null,$vehiculos=null,$ventass=[];
    ////////////////


    public $i = 0;
    public $j = 0;
    public $k = 0;


    public $fecha;


    public $usuarios=[];


    public $envio_id=null;

    public $venta_id=null;
    public $inputsVenta=[];
    public $ventaContador=null;

    public $ventaDetalle=[];
    public $idDetalleVenta=[];
    public $noVenta=[];

    public $totalVenta=[];
    public $nombreCliente=[];

    public $user_id=null;
    public $inputsUsuario=[];
    public $usuarioContador=null;
    public $usuarioDetalle=[];
    public $idDetalleUsuario=[];


    public $vehiculo_id=null;
    public $inputsVehiculo=[];
    public $vehiculoDetalle=[];
    public $aliasVehiculo=[];
    public $vehiculoContador=null;
    public $idDetalleVehiculo=[];
    public $codigoVehiculo=[];

    public $estados,$procesos;

    public $observaciones_inicio_envio=null, $observaciones_final_envio=null,$estado='Iniciado';
    public $envio=null;


    public $envio_no=null;
    public $envio_fecha=null;

    public $ruta_id=null;
    public $id=0;

    public $proceso_id=null;
    public $proceso_nombre=null;

    public $estado_id=null;
    public $estado_nombre=null;
    public $estado_fecha=null;
    public $estado_observacion=null;

    public $user_id_created_at=null;
    public $user_name_created_at=null;

    public $visible=false;
    public $finalizado=false;

    public $disabled_envio_no=true;

public $disabled_venta=true,$disabled_user=true,$disabled_vehiculo=true;
public $diabled_proceso_id=false,$disabled_estado_id=false,$disabled_estado_obserbacion=false,$disabled_estado_fecha=false;

//////////////delete/////////
public $delete_no=null,$delete_nombre=null;



//////////////////

public $filtroNoEnvio=null;

public $filtroEstadoEnvio=null;
public $filtroRuta=null;
public $filtroNoVenta=null;
public $filtroUsuario=null;
public $filtroVehiculo=null;


public $filtroFecha=null;
public $filtroFechaInicio=null;
public $filtroFechaFin=null;


////////////////


    protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public function mount()
    {
        $this->filtroFechaInicio=Carbon::now()->format('Y')."-01-01";
        $this->filtroFechaFin=Carbon::now()->toDateString();
    }
    public function updatedFiltroFecha($id){
        if(Str ::length($id)==10){
            $this->filtroFechaInicio=$id;
            $this->filtroFechaFin=$id;
        }else{
            $this->filtroFechaInicio=Str::substr($id, 0, 10);
            $this->filtroFechaFin=Str::substr($id, 13, 25);
        }
    }
    public function borrarFiltros()
    {
        $this->reset();
        $this->mount();
    }



    public function render()
    {

        $this->estados=DataSistema::$estados_envio;
        $this->usuarios=User::all();
        $this->rutas=Ruta::all();
        $this->vehiculos=Vehiculo::all();


        $data_temp=Envio::where('envio_no','LIkE',"%{$this->filtroNoEnvio}%")->with('users')->with('vehiculos')->with('ruta')
            ->where('ruta_id','LIkE',"%{$this->filtroRuta}%")
            ->whereRelation('users','id','LIKE',"%{$this->filtroUsuario}%")
            ->whereRelation('vehiculos','id','LIKE',"%{$this->filtroVehiculo}%")

            ->where('estado_envio','LIkE',"%{$this->filtroEstadoEnvio}%")
            ->latest();

        if(!empty($this->filtroFecha)){
            $data_temp->whereBetween('envio_fecha',[$this->filtroFechaInicio,$this->filtroFechaFin]);
        }

        $data_temp=$data_temp->paginate($this->per_page);
        return view('livewire.pages.envio.index', [
            'envios' => $data_temp,
        ]);
    }

    public function create(){
        $this->envio_fecha= Carbon::now()->toDateString();
        $this->diabled_proceso_id=true;
        $this->disabled_estado_id=false;
        $this->disabled_estado_obserbacion=false;
        $this->disabled_estado_fecha=true;

        $this->proceso_id=1;
        $this->estado_id=3;

        $data=Envio::latest()->first();


        if ( $data) {
            $this->id=$data->id+1;
            $this->envio_no=$this->id;
        }else{
            $this->id=1;
            $this->envio_no=$this->id;
        }

        $this->usuarios=User::all();
        $this->ventas=Venta::where('envio','=','ENVIO')->where('estado_envio','=','SIN ASIGNAR')->get();
        $this->rutas=Ruta::all();
        $this->vehiculos=Vehiculo::all();
        $this->isCreate=true;
    }

    public function show($rowId){

        $this->isShow=true;
        $this->disabled=true;
        $data=Envio::find($rowId);



        $this->envio_no=$data->envio_no;
        $this->envio_fecha=$data->envio_fecha;
        $this->ruta_id=$data->ruta->nombre;
        $this->observaciones_inicio_envio=$data->observaciones_inicio_envio;
        foreach ($data->ventas as $key => $value) {
                array_push($this->inputsVenta,$this->i);
                array_push($this->noVenta,$value->no_venta);
                array_push($this->totalVenta,$value->total_venta);
                array_push($this->nombreCliente,$value->cliente->nombres_cliente);
                array_push($this->idDetalleVenta,$value->id);
                $this->i++;
        }

        foreach ($data->Users as $key => $value) {
                array_push($this->inputsUsuario,$key);
                array_push($this->usuarioDetalle,$value->nombres);
                array_push($this->idDetalleUsuario,$value->id);
                $key++;
        }


        foreach ($data->vehiculos as $key => $value) {

                array_push($this->inputsVehiculo,$key);
                array_push($this->codigoVehiculo,$value->codigo);
                array_push($this->aliasVehiculo,$value->alias);
                array_push($this->idDetalleVehiculo,$value->id);
                $key++;

        }



        $this->disabled=true;
        $this->isShow=true;
    }


public function update()
{
    $this->validate([
        'envio_fecha' => 'required',
        'ruta_id' => 'required',
        'idDetalleVenta' => 'required|array|min:1',
        'idDetalleUsuario' => 'required|array|min:1',
        'idDetalleVehiculo' => 'required|array|min:1',
    ]);

    $data = Envio::findOrFail($this->envio_id);

    $data->update([
        'envio_fecha' => $this->envio_fecha,
        'ruta_id' => $this->ruta_id,
        'observaciones_inicio_envio' => $this->observaciones_inicio_envio,
    ]);

    // Sincronizar relaciones
    $data->ventas()->sync($this->idDetalleVenta);
    $data->users()->sync($this->idDetalleUsuario);
    $data->vehiculos()->sync($this->idDetalleVehiculo);

    // Resetear estados de ventas antiguas y nuevas
    foreach ($data->ventas as $venta) {
        Venta::find($venta->id)->update([
            'estado_envio' => 'PROCESO'
        ]);
    }
    $this->alertaNotificacion("update");
    $this->cancel();
}


public function edit($rowId)
{
    $this->isEdit = true;
    $this->disabled = false;

    $data = Envio::with('ventas', 'users', 'vehiculos')->findOrFail($rowId);

    $this->envio_id = $data->id;
    $this->envio_no = $data->envio_no;
    $this->envio_fecha = $data->envio_fecha;
    $this->ruta_id = $data->ruta_id;
    $this->observaciones_inicio_envio = $data->observaciones_inicio_envio;

    // Reset arrays
    $this->inputsVenta = [];
    $this->idDetalleVenta = [];
    $this->noVenta = [];
    $this->totalVenta = [];
    $this->nombreCliente = [];

    $this->inputsUsuario = [];
    $this->idDetalleUsuario = [];
    $this->usuarioDetalle = [];

    $this->inputsVehiculo = [];
    $this->idDetalleVehiculo = [];
    $this->codigoVehiculo = [];
    $this->aliasVehiculo = [];

    // Ventas
    foreach ($data->ventas as $key => $value) {
        $this->inputsVenta[] = $key;
        $this->idDetalleVenta[] = $value->id;
        $this->noVenta[] = $value->no_venta;
        $this->totalVenta[] = $value->total_venta;
        $this->nombreCliente[] = $value->cliente->nombres_cliente;
    }

    // Usuarios
    foreach ($data->users as $key => $value) {
        $this->inputsUsuario[] = $key;
        $this->idDetalleUsuario[] = $value->id;
        $this->usuarioDetalle[] = $value->nombres;
    }

    // Vehículos
    foreach ($data->vehiculos as $key => $value) {
        $this->inputsVehiculo[] = $key;
        $this->idDetalleVehiculo[] = $value->id;
        $this->codigoVehiculo[] = $value->codigo;
        $this->aliasVehiculo[] = $value->alias;
    }

    // Catálogos
    $this->usuarios = User::all();
    $this->ventas = Venta::where('envio', 'ENVIO')->get();
    $this->rutas = Ruta::all();
    $this->vehiculos = Vehiculo::all();
}






    public function borrador (){
        $this->proceso_id=1;
        $this->estado_id=3;
        $this->store();
    }

    public function addDetalleVenta(){

        foreach ($this->ventas as $key => $value) {
            if($value['id']===intval($this->venta_id)){
                array_push($this->inputsVenta,$this->i);
                array_push($this->noVenta,$value['no_venta']);
                array_push($this->totalVenta,$value['total_venta']);
                array_push($this->nombreCliente,$value->cliente['nombres_cliente']);
                array_push($this->idDetalleVenta,$value['id']);
                $this->i++;
            }
        }
        $this->reset(['venta_id','user_id','vehiculo_id']);
    }


    public function addDetalleUsuario(){
        foreach ($this->usuarios as $key => $value) {
            if($value['id']===intval($this->user_id)){
                array_push($this->inputsUsuario,$this->j);
                array_push($this->usuarioDetalle,$value['nombres']);
                array_push($this->idDetalleUsuario,$value['id']);
                $this->j++;
            }
        }
        $this->reset(['venta_id','user_id','vehiculo_id']);
    }

    public function addDetalleVehiculo(){
        foreach ($this->vehiculos as $key => $value) {
            if($value['id']===intval($this->vehiculo_id)){

                array_push($this->inputsVehiculo,$this->k);
                array_push($this->codigoVehiculo,$value['codigo']);
                array_push($this->aliasVehiculo,$value['alias']);
                array_push($this->idDetalleVehiculo,$value['id']);
                $this->k++;
            }
        }
        $this->reset(['venta_id','user_id','vehiculo_id']);
    }



    public function exportarGeneral()
    {
        $data_temp=Envio::where('envio_no','LIkE',"%{$this->filtroNoEnvio}%")->with('users')->with('vehiculos')
        ->where('ruta_id','LIkE',"%{$this->filtroRuta}%")
        ->whereRelation('users','id','LIKE',"%{$this->filtroUsuario}%")
        ->whereRelation('vehiculos','id','LIKE',"%{$this->filtroVehiculo}%")

        ->where('estado_envio','LIkE',"%{$this->filtroEstadoEnvio}%")
        ->latest();

        if(!empty($this->filtroFecha)){
            $data_temp->whereBetween('envio_fecha',[$this->filtroFechaInicio,$this->filtroFechaFin]);
        }

    $data_temp=$data_temp->paginate($this->per_page);
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfEnvioGeneral',['data'=>$data_temp]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }




    public function store(){

        $this->validate(['envio_no'=>'required','envio_fecha'=>'required','ruta_id'=>'required',
        'i'=>'numeric|min:1','j'=>'numeric|min:1','k'=>'numeric|min:1']);
        $data=Envio::create(
            [
                'envio_no'=>$this->envio_no,
                'envio_fecha'=>$this->envio_fecha,
                'ruta_id'=>$this->ruta_id,
                'estado_envio'=>"PROCESO",
                'observaciones_inicio_envio'=>$this->observaciones_inicio_envio,
                'visible'=>'1',
                'finalizado'=>'0',
            ]);

        $data->ventas()->attach($this->idDetalleVenta);
        $data->users()->attach($this->idDetalleUsuario);
        $data->vehiculos()->attach($this->idDetalleVehiculo);


        foreach ($this->idDetalleVenta as $key => $value) {
            $data=Venta::find($value);
            $data->update([
                'estado_envio'=>"PROCESO"
            ]);
        }

    ////////////////////
    $this->alertaNotificacion("store");
        $this->reset();
    }

    public function finalizar($id){
        $this->isFinalizar=true;
        $this->disabled=true;
        $this->disabled_observaciones_inicio_envio=true;
        $this->rutas=Ruta::all();
        $this->envio=Envio::where('id','=',$id)->with('ventas')->with('vehiculos')->with('users')->first();
        $this->disabled_observaciones_inicio_envio=true;
        $this->envio_id=$this->envio->id;
        $this->envio_no=$this->envio->envio_no;
        $this->envio_fecha=$this->envio->envio_fecha;
        $this->ruta_id=$this->envio->ruta_id;
        $this->created_at = $this->envio->created_at;
        $this->updated_at = $this->envio->updated_at;
        $this->observaciones_inicio_envio = $this->envio->observaciones_inicio_envio;
        ////////////////////
    }


public function removeDetalleVenta($index)
{
    if (isset($this->inputsVenta[$index])) {

        unset($this->inputsVenta[$index]);
        unset($this->noVenta[$index]);
        unset($this->totalVenta[$index]);
        unset($this->nombreCliente[$index]);
        unset($this->idDetalleVenta[$index]);

        // Reindexar arrays para evitar errores en Livewire
        $this->inputsVenta = array_values($this->inputsVenta);
        $this->noVenta = array_values($this->noVenta);
        $this->totalVenta = array_values($this->totalVenta);
        $this->nombreCliente = array_values($this->nombreCliente);
        $this->idDetalleVenta = array_values($this->idDetalleVenta);

        // Ajustar contador
        $this->i = count($this->inputsVenta);
    }
}



    public function removeDetalleUsuario($index)
    {
        if (isset($this->inputsUsuario[$index])) {

            unset($this->inputsUsuario[$index]);
            unset($this->usuarioDetalle[$index]);
            unset($this->idDetalleUsuario[$index]);

            // Reindexar
            $this->inputsUsuario = array_values($this->inputsUsuario);
            $this->usuarioDetalle = array_values($this->usuarioDetalle);
            $this->idDetalleUsuario = array_values($this->idDetalleUsuario);

            // Ajustar contador
            $this->j = count($this->inputsUsuario);
        }
    }



public function removeDetalleVehiculo($index)
{
    if (isset($this->inputsVehiculo[$index])) {

        unset($this->inputsVehiculo[$index]);
        unset($this->codigoVehiculo[$index]);
        unset($this->aliasVehiculo[$index]);
        unset($this->idDetalleVehiculo[$index]);

        // Reindexar arrays
        $this->inputsVehiculo = array_values($this->inputsVehiculo);
        $this->codigoVehiculo = array_values($this->codigoVehiculo);
        $this->aliasVehiculo = array_values($this->aliasVehiculo);
        $this->idDetalleVehiculo = array_values($this->idDetalleVehiculo);

        // Ajustar contador
        $this->k = count($this->inputsVehiculo);
    }
}




    public function store_finish(){
            ////////////////////
            $data = Envio::find($this->envio_id);
            $data->update([
                'observaciones_fin_envio'=>$this->observaciones_final_envio,
                'estado_envio'=>"FINALIZADO",
                'finalizado'=>true
            ]);

            foreach ($data->ventas  as $key => $value) {
                $data = Venta::find($value['id']);
                $data->update([
                    'estado_envio'=>"FINALIZADO"
                ]);
            }
        ////////////////////
        $this->alertaNotificacion("store");
                $this->dispatch('pg:eventRefresh-envioTable');
            $this->cancel();
    }

    public function delete($rowId){
        $data = Envio::find($rowId);
        $this->id_data= $data->id;
        $this->isDelete = true;
        $this->delete_no=$data->envio_no;
        $this->delete_nombre=$data->envio_fecha;
    }

    public function destroy($id){

        $data = Envio::find($id)->with('ventas')->first();

        foreach ($data->ventas as $key => $value) {
            Venta::find($value->id)
            ->update(['estado_envio' => 'SIN ASIGNAR']);
        }
        $data->ventas()->detach();
        $data->users()->detach();
        $data->vehiculos()->detach();

        $data->delete();

        $this->alertaNotificacion("destroy");
/*


*/


        $this->isDelete = false;
        $this->cancel();
    }

        public function exportarFila($rowId)
    {
        $data_temp=Envio::find($rowId);
         $data=exportarFilaPDF('Envio', [
            'data' => $data_temp,
        ]);
        return $data;
    }


    public function cancel(){
        $this->dispatch('pg:eventRefresh-envioTable');
        $this->reset();
        $this->resetValidation();
    }

    public function alertaNotificacion($tipo){
        $alerta="";
        $title="";
        $texto="";
        if($tipo==="store"){

            $title="Agregar";
            $texto="Registro agregado";
            $alerta="success";

        }elseif($tipo==="update"){
            $title="Editar";
            $texto="Registro editado";
            $alerta="success";

        }elseif($tipo==="destroy"){
            $title="Borrar";
            $texto="Registro borrado";
            $alerta="success";
        }elseif($tipo==="error"){
            $title="Error";
            $texto="No se completo la operación";
            $alerta="error";
        }
        return $this->alert("$alerta", "$title", [
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
