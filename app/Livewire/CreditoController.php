<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Ruta;
use App\Models\Venta;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;

class CreditoController extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $title='Credito';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $disabled=false;
public $observaciones_credito;

    public $no_credito=null, $venta_id=null, $fecha_credito=null, $total_credito=null, $cliente_id=null, $observaciones=null, $created_at=null, $updated_at=null;
    public $nombres_cliente=null, $apellidos_cliente=null;
    protected $rules = [
        'codigo' => 'required',
        'tipo_vehiculo' => 'required',
        'tipo_placa' => 'required',
        'numero_placa' => 'required',
        'marca' => 'required',
        'modelo' => 'required',
        'linea' => 'required',
        'alias' => 'required',
    ];





    /////////filtros
    public $filtroNoCredito=null;
    public $filtroNombreCliente=null;
    public $filtroCodigoCliente=null;
    Public $filtroFechaCredito=null;

    public $creditos=[];


    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;
    public $clientes=[],$estado_cuentas=[],$total_creditos;
    /////
  protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public $filtroFecha=null;
    public $filtroFechaInicio=null;
    public $filtroFechaFin=null;

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

        $this->creditos=Venta::where('credi','1')->get();

        //dd($this->creditos);


        //dd($this->creditos);


        return view('livewire.pages.credito.index');
    }


    public function show($rowId){
$this->disabled=true;
        $this->isShow=true;
        $data=Venta::find($rowId);

        $this->no_credito=$data->no_venta;
        $this->venta_id=$data->no_venta;
        $this->fecha_credito=$data->fecha_venta;
        $this->total_credito=$data->total_credito;

        $this->cliente_id=$data->cliente_id;
        $this->nombres_cliente=$data->cliente->nombres_cliente;
        $this->apellidos_cliente=$data->cliente->apellidos_cliente;

        $this->observaciones_credito=$data->observaciones_credito;
        $this->created_at=$data->created_at;
        $this->updated_at=$data->updated_at;

        $this->disabled=true;
        $this->isShow=true;
        ////////////////////
    }

    public function cancel(){
        $this->dispatch('pg:eventRefresh-creditoTable');
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','created_at','updated_at']);
        $this->reset(['no_credito','venta_id','fecha_credito','total_credito','cliente_id','nombres_cliente','apellidos_cliente','observaciones','created_at','updated_at']);
    }


    public function exportarFila($rowId)
    {
        $data_temp=Venta::find($rowId);
         $data=exportarFilaPDF('Credito', [
            'data' => $data_temp,
        ]);
        return $data;
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
