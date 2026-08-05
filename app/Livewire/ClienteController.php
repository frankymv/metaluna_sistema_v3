<?php

namespace App\Livewire;

use Illuminate\Support\Str;

use App\Constantes\DataSistema;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Ruta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;
class ClienteController extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $title='Cliente';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $last_dep=false;
    public $codigotemp_dep,$codigotemp_mun,$codigotemp;


    public $isDisabledMinorista=true;

    public $disabledCodigo=true,
    $codigo_interno=null,
    $codigo_mayorista="N/A",
    $nombre_empresa='',
    $nombres_cliente='',
    $tipo_cliente_id=null,
    $apellidos_cliente='',
    $cui='',
    $numero_patente='',
    $nit='',
    $telefono_principal='',
    $telefono_secundario='',
    $direccion_fisica='',
    $direccion_departamento=null,
    $direccion_municipio=null,
    $ubicacion_latitud=0,
    $ubicacion_longitud=0,
    $correo_electronico,
    $limite_credito=0,
    $dias_limite_credito=30,
    $estado=true,
    $id=0;


    public $rutas;
    public $tipo_clientes=[];

    ////disabled////////
    public $disabled_codigo_interno=false;

    public $departamentos=[], $municipios=[];
    public $departamento_id, $municipio_id;
    public $departamento,$municipio;


    //////DELETE///
    public $delete_no=null;
    public $delete_nombre=null;

    public $filtroFecha=null;
    public $filtroFechaInicio=null;
    public $filtroFechaFin=null;


    protected $listeners=['create','edit', 'delete','show','exportarFila'];


    public function render()
    {
        return view('livewire.pages.cliente.index');
    }

    public function create(){
        $this->codigo_interno=Cliente::siguienteCodigoInterno();
        $this->codigo_mayorista=Cliente::siguienteCodigoMayorista();
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->disabled_codigo_interno=true;
        $this->isCreate=true;
        $this->tipo_cliente_id='MIN';
    }

    public function updatedTipoClienteId (String $value){
        if($value==='MINO')
        {
            $this->isDisabledMinorista=true;
            $this->reset(['numero_patente','cui','ubicacion_latitud' ,'ubicacion_longitud','limite_credito','dias_limite_credito']);
        }elseif ($value==='MAYO'){
            $this->isDisabledMinorista=false;
            $this->codigo_mayorista=Cliente::siguienteCodigoMayorista();
        }
    }

    public function exportarGeneral(){
        $data_temp=Cliente::where('codigo_interno','LIkE',"%{$this->filtroCodigoInterno}%")
        ->where('codigo_mayorista','LIkE',"%{$this->filtroCodigMayorista}%")
        ->where('tipo_cliente','LIkE',"%{$this->filtroTipoCliente}%")
        ->where('nombres_cliente','LIkE',"%{$this->filtroNombresCliente}%")
        ->where('apellidos_cliente','LIkE',"%{$this->filtroApellidosCliente}%")
        ->paginate($this->per_page);

        $data=exportarGeneralPDF('Cliente', [
            'datas' => $data_temp,
        ]);
        return $data;
    }



    public function store(){
        $data=[];
        $codigoInterno=Cliente::siguienteCodigoInterno();
        $codigoMayorista=null;

        if($this->tipo_cliente_id==="MAYO"){
            $this->validate([
                'limite_credito'=>'required|min:1|numeric',
                'tipo_cliente_id' => 'required',
                'nombres_cliente' => 'required',
                'apellidos_cliente' => 'required',
                'direccion_fisica' => 'required',
                'direccion_departamento' => 'required',
                'direccion_municipio' => 'required',
            ]);
            $codigoMayorista=Cliente::siguienteCodigoMayorista();
        }else{
            $this->validate([
                'tipo_cliente_id' => 'required',
                'nombres_cliente' => 'required',
                'apellidos_cliente' => 'required',
                'direccion_fisica' => 'required',
                'direccion_departamento' => 'required',
                'direccion_municipio' => 'required',
            ]);
            $this->isDisabledMinorista=false;
        }

        Cliente::create([
            'codigo_interno'=> $codigoInterno,
            'codigo_mayorista'=> $codigoMayorista,
            'nombre_empresa'=> $this->nombre_empresa,
            'nombres_cliente'=>$this->nombres_cliente,
            'apellidos_cliente'=>$this->apellidos_cliente,
            'cui'=>$this->cui,
            'numero_patente'=>$this->numero_patente,
            'nit'=>$this->nit,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'ubicacion_latitud'=>$this->ubicacion_latitud,
            'ubicacion_longitud'=>$this->ubicacion_longitud,
            'correo_electronico'=>$this->correo_electronico,
            'limite_credito'=>$this->limite_credito,
            'dias_limite_credito'=>$this->dias_limite_credito,
            'tipo_cliente'=>$this->tipo_cliente_id,
            'estado'=>$this->estado
        ]);
        $this->alertaNotificacion("store");
        $this->cancel();
    }

    public function edit($rowId){
        $data = Cliente::find($rowId);
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->municipios = Municipio::where('departamento_id',$data->direccion_departamento)->get();

        $this->id_data=$data->id;
        $this->codigo_interno = $data->codigo_interno;
        $this->codigo_mayorista = $data->codigo_mayorista;
        $this->nombre_empresa = $data->nombre_empresa;
        $this->nombres_cliente = $data->nombres_cliente;
        $this->apellidos_cliente = $data->apellidos_cliente;
        $this->cui = $data->cui;
        $this->numero_patente = $data->numero_patente;
        $this->nit = $data->nit;
        $this->telefono_principal = $data->telefono_principal;
        $this->telefono_secundario = $data->telefono_secundario;
        $this->direccion_fisica = $data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->ubicacion_latitud = $data->ubicacion_latitud;
        $this->ubicacion_longitud = $data->ubicacion_longitud;
        $this->correo_electronico = $data->correo_electronico;
        $this->estado = $data->estado;
        $this->limite_credito=$data->limite_credito;
        $this->dias_limite_credito=$data->dias_limite_credito;
        $this->tipo_cliente_id=$data->tipo_cliente;

        if($data->tipo_cliente!='MAYO')
        {
            $this->isDisabledMinorista=true;
        }else{
            $this->isDisabledMinorista=false;

        }
        $this->isEdit = true;
    }


    public function show($rowId){

        $this->disabled=true;
        $data = Cliente::find($rowId);
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->municipios = Municipio::where('departamento_id',$data->direccion_departamento)->get();
        $this->id_data=$data->id;
        $this->codigo_interno = $data->codigo_interno;
        $this->codigo_mayorista = $data->codigo_mayorista;
        $this->nombre_empresa = $data->nombre_empresa;
        $this->nombres_cliente = $data->nombres_cliente;
        $this->apellidos_cliente = $data->apellidos_cliente;
        $this->cui = $data->cui;
        $this->numero_patente = $data->numero_patente;
        $this->nit = $data->nit;
        $this->telefono_principal = $data->telefono_principal;
        $this->telefono_secundario = $data->telefono_secundario;
        $this->direccion_fisica = $data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->ubicacion_latitud = $data->ubicacion_latitud;
        $this->ubicacion_longitud = $data->ubicacion_longitud;
        $this->correo_electronico = $data->correo_electronico;
        $this->estado = $data->estado;
        $this->limite_credito=$data->limite_credito;
        $this->dias_limite_credito=$data->dias_limite_credito;
        $this->tipo_cliente_id=$data->tipo_cliente;
        $this->isShow=true;
        }

    public function update($rowId){
        $this->validate();
        Cliente::find($rowId)->update([
            'codigo_interno'=> $this->codigo_interno,
            'codigo_mayorista'=> $this->codigo_mayorista,
            'nombre_empresa'=> $this->nombre_empresa,
            'nombres_cliente'=>$this->nombres_cliente,
            'apellidos_cliente'=>$this->apellidos_cliente,
            'cui'=>$this->cui,
            'numero_patente'=>$this->numero_patente,
            'nit'=>$this->nit,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'ubicacion_latitud'=>$this->ubicacion_latitud,
            'ubicacion_longitud'=>$this->ubicacion_longitud,
            'correo_electronico'=>$this->correo_electronico,
            'limite_credito'=>$this->limite_credito,
            'dias_limite_credito'=>$this->dias_limite_credito,
            'tipo_cliente'=>$this->tipo_cliente_id,
            'estado'=>$this->estado
        ]);
        $this->alertaNotificacion("update");
        $this->cancel();
    }

    public function delete($rowId){
        $data = Cliente::find($rowId);
        $this->id_data=$data->id;
        $this->delete_no= $data->codigo_interno;
        $this->delete_nombre= $data->nombres_cliente;
        $this->isDelete = true;
    }


    public function destroy($id)
    {
        Cliente::find($id)->delete();
        $this->alertaNotificacion("destroy");
        $this->cancel();
    }

    public function cancel(){
        $this->dispatch('pg:eventRefresh-clienteTable');
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        $this->reset(['codigo_interno','nombre_empresa','isDisabledMinorista' ,'tipo_cliente_id','nombres_cliente', 'apellidos_cliente','cui', 'numero_patente','nit','telefono_principal' ,'telefono_secundario', 'direccion_fisica','direccion_departamento','direccion_municipio','ubicacion_latitud' ,'ubicacion_longitud', 'correo_electronico','departamento_id','municipio_id','departamentos','municipios','limite_credito','dias_limite_credito']);

    }

    public function exportarFila($rowId)
    {
        $data_temp=Cliente::find($rowId);
         $data=exportarFilaPDF('Cliente', [
            'data' => $data_temp,
        ]);
        return $data;
    }





    public function updatedDireccionDepartamento($value){
        $codigo=Departamento::find($value);
        $this->municipios = Municipio::where('departamento_id',$value)->get();
        $this->last_dep=true;
        $this->reset('municipio_id');
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
