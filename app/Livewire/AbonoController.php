<?php

namespace App\Livewire;
use Illuminate\Support\Str;
use App\Constantes\DataSistema;
use App\Models\Abono;
use App\Models\Cliente;
use App\Models\Venta;
use Livewire\Component;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class AbonoController extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $title='Abono';
    public $data, $per_page=10,  $id_venta=null,$id=null,$no_abono=0;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isCreateAnticipado = false,$isCreateAnticipadoAsignar = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false,$disabledAsignarAbonoAnticipado=false;
    public $nuevo_saldo=0, $fecha_abono=null,$abono_anticipados=null;
    public $tipo_pago=null, $tipo_pago_id=null,$no_pago=0,$detalle_pago='',$clientes=null;

    public $venta_id=null,$abono_anticipado_id=null,$cantidad_credito_actual=0,$cantidad_abono=0,$saldo_credito=0,$estado=0,$observaciones=null,$correlativo=0;
    public $id_data=null;
    public $correlativo_abono=0;
    public $abono_id=null;

    //bono anticipado
    public $cliente_id=null;
    public $cantidad_abono_anticipado=null;
    public $clientes_search;

    //bono anticipado asignar
    public $saldo_credito_asignar=0;
    public $cantidad_abono_asignar=0;
    public $nuevo_saldo_asignar=0;
    public $asignar_venta_id=null;
    public $asignar_abono_anticipado_id=null;
    public $abono_anticipado=0;

    public $ventas_credito=null;
    public $isSearchVenta=false;
    public $isSearchCliente=false;
    public $ventas=[];
    public $no_venta=0;

    public $search_no_venta,$search_nombres_cliente,$search_codigo_cliente,$search_nombres_cliente_anticipado,$search_codigo_cliente_anticipado;

    public $abono_anticipado_asignado;
    public $fecha_abono_anticipado_asignado;
    /////////filtros
    public $filtroNoAbono=null;
    public $filtroNoVenta=null;
    public $filtroNombreCliente=null;
    public $filtroCodigoCliente=null;
    Public $filtroFechaAbono=null;

    public $titulo_abono;
    public $creditos=[];

    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0,$total_abono=0,$total_nota_credito=0;
    public $abonos=[],$estado_cuentas=[],$total_abonos;
    //cliente
    public $codigo_interno=null,$nombre_empresa=null,$nombres_cliente=null,$apellidos_cliente=null;
    //venta
    public $total_venta=0,$fecha_venta=null;
    public $saldo_cancelado=false;

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required'
    ];

    public $suma_total_abono=0;
    protected $listeners=['create','edit', 'delete','show','exportarFila','abonoAnticipado','abonoAnticipadoAsignar'];

    public function render()
    {
        return view('livewire.pages.abono.index');
    }

    ////////////////// ABONO////////////////////////
    public function create()
    {
        $this->disabled=true;
        $this->no_abono = Abono::siguienteNoRegistro();
        $this->tipo_pago=DataSistema::$forma_pago;
        $this->fecha_abono = Carbon::now()->toDateString();
        $this->isCreate=true;
    }

    public function buscarVenta()
    {
        $this->isSearchVenta=true;
        $this->isCreate=false;
    }

    public function buscarCliente()
    {
        $this->isSearchCliente=true;
        $this->isCreateAnticipado=false;
    }

    public function updatedSearchNoVenta(String $value)
    {
        $this->reset(['search_nombres_cliente','search_codigo_cliente']);
        $this->ventas=Venta::with("cliente")
        ->where('no_venta',$value)
        ->where('credi',true)
        ->where('cancelado_total_venta','=',false)
        ->where('anulado','=',false)
        ->get();
    }

    public function updatedSearchNombresCliente(String $value)
    {
        $this->reset(['search_no_venta','search_codigo_cliente']);
        $this->ventas=Venta::with('cliente')->where('credi',true)->where('cancelado_total_venta','=',false)
            ->where('anulado','=',false)
            ->whereRelation('cliente','nombres_cliente','LIKE',"%{$value}%")->get();
    }

    public function updatedSearchCodigoCliente($value)
    {
        $this->reset(['search_nombres_cliente','search_no_venta']);
        $this->ventas=Venta::with('cliente')
        ->where('cancelado_total_venta','=',false)
            ->where('anulado','=',false)
        ->whereRelation('cliente','codigo_mayorista','LIKE',"%{$value}%")->get();

        $this->suma_total_abono=Venta::with('cliente')
        ->where('cancelado_total_venta','=',false)
        ->where('anulado','=',false)
        ->whereRelation('cliente','codigo_mayorista','LIKE',"%{$value}%")->sum('total_abono');
    }
    ///////bomno anticipado para clientes busquieda
    public function updatedSearchNombresClienteAnticipado(String $value)
    {
        $this->reset(['search_codigo_cliente_anticipado']);
        $this->clientes_search=Cliente::where('nombres_cliente','LIKE',"%{$value}%")->get();
    }

    public function updatedSearchCodigoClienteAnticipado(String $value)
    {
        $this->reset(['search_nombres_cliente_anticipado']);
        $this->clientes_search=Cliente::where('codigo_mayorista','LIKE',"%{$value}%")->get();
    }

    public function agregarVenta(String $id)
    {
        $this->cancelarBuscarVenta();
        $venta=Venta::find($id);
        $this->no_venta=$venta->no_venta;
        $this->venta_id=$venta->id;
        $this->fecha_venta=$venta->fecha_venta;
        $this->cliente_id=$venta->cliente_id;
        $this->codigo_interno=$venta->cliente->codigo_interno;
        $this->nombre_empresa=$venta->cliente->nombre_empresa;
        $this->nombres_cliente=$venta->cliente->nombres_cliente;
        $this->apellidos_cliente=$venta->cliente->apellidos_cliente;
        $this->correlativo=$venta->correlativo+1;
        $this->id_venta=$venta->id;
        $this->total_venta=$venta->total_venta;
        $this->total_abono=$venta->total_abono;
        $this->total_nota_credito=$venta->total_nota_credito;
        $this->saldo_credito=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;
        $this->cantidad_credito_actual=$venta->saldo_total_venta ;
        $this->reset(['abono_anticipado_id','cantidad_abono','nuevo_saldo']);
    }

    public function updatedCantidadAbono($value)
    {
        $this->validate([
            'cantidad_abono'=>"numeric|required|min:1|max:$this->saldo_credito"
        ]);
        $this->nuevo_saldo=$this->saldo_credito-$value;
    }

    public function store()
    {
        $this->validate([
            'cantidad_abono'=>"numeric|required|min:1|max:$this->saldo_credito",
            'fecha_abono'=>'required',
            'tipo_pago_id'=>'required',
        ]);

        $no_abono = Abono::siguienteNoRegistro();
        $venta=Venta::find($this->id_venta);
        $venta->correlativo+=1;
        $venta->abono=true;

        Abono::create([
            'no_abono'=>$no_abono,
            'fecha_abono'=>$this->fecha_abono,
            'total_abono'=>$this->cantidad_abono,
            'observaciones'=>$this->observaciones,
            'tipo_pago'=>$this->tipo_pago_id,
            'detalle_pago'=>$this->detalle_pago,
            'correlativo'=>$venta->correlativo,
            'venta_id'=>$this->id_venta,
            'cliente_id'=>$this->cliente_id,
        ]);

        if($venta->total_credito==($venta->total_abono+$venta->total_nota_credito)){
            $venta->fecha_cancelado_total_venta=$this->fecha_abono;
            $venta->cancelado_total_venta=TRUE;
        }

        //////manejo de abonos totales y abono actuales
        $venta->total_abono=$venta->total_abono+$this->cantidad_abono;
        $venta->saldo_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;

        $venta->save();
        $this->alertaNotificacion("store");
        $this->cancel();
    }
    
/////////////////////////////////ABONO ANTICIPADO/////////////////////////////
    public function abonoAnticipado()
    {
        $this->no_abono=Abono::siguienteNoRegistro();
        $this->tipo_pago=DataSistema::$forma_pago;
        $this->fecha_abono = Carbon::now()->toDateString();
        $this->clientes=Cliente::all();
        $this->isCreateAnticipado=true;
    }

    public function storeAnticipado()
    {
        $this->validate([
            'cantidad_abono'=>"numeric|required|min:1",
            'fecha_abono'=>'required',
            'tipo_pago_id'=>'required',
        ]);

        $no_abono=Abono::siguienteNoRegistro();
        Abono::create([
            'no_abono'=>$no_abono,
            'fecha_abono'=>$this->fecha_abono,
            'total_abono'=>$this->cantidad_abono,
            'observaciones'=>$this->observaciones,
            'tipo_pago'=>$this->tipo_pago_id,
            'detalle_pago'=>$this->detalle_pago,
            'cliente_id'=>$this->cliente_id,
            'abono_anticipado'=>true,
            'abono_anticipado_asignado'=>false,
        ]);

        $this->alertaNotificacion("store");
        $this->cancel();

    }

    public function agregarCliente($id)
    {
        $this->isSearchCliente=false;
        $this->isCreateAnticipado=true;
        $cliente=Cliente::find($id);
        $this->cliente_id=$cliente->cliente_id;
        $this->codigo_interno=$cliente->codigo_interno;
        $this->nombre_empresa=$cliente->nombre_empresa;
        $this->nombres_cliente=$cliente->nombres_cliente;
        $this->apellidos_cliente=$cliente->apellidos_cliente;
        $this->cliente_id=$cliente->id;
    }

    //////////////////////////////////ASIGNAR ABONO ANTICIPADO/////////////////////////////////////
    public function abonoAnticipadoAsignar()
    {
        $this->ventas_credito=Venta::where('cancelado_total_venta','=',false)
        ->where('anulado','=',false)->get();
        $this->disabledAsignarAbonoAnticipado=true;
        $this->fecha_abono = Carbon::now()->toDateString();
        $this->tipo_pago=DataSistema::$forma_pago;
        $this->ventas=Venta::where('cancelado_total_venta',false)->get();
        $this->abono_anticipados=Abono::where('abono_anticipado',true)->where('abono_anticipado_asignado',false)->get();
        $this->isCreateAnticipadoAsignar=true;
    }

    public function updatedAsignarVentaId($value)
    {

        $this->reset(['abono_anticipado_id','cantidad_abono','nuevo_saldo','asignar_abono_anticipado_id','no_venta','fecha_venta','total_venta','saldo_credito','codigo_interno',
            'nombre_empresa','nombres_cliente','apellidos_cliente','cantidad_abono_asignar','nuevo_saldo_asignar']);
        $this->resetErrorBag('nuevo_saldo');
        $venta=Venta::find($value);

        $this->no_venta=$venta->no_venta;
        $this->venta_id=$venta->id;
        $this->fecha_venta=$venta->fecha_venta;
        $this->cliente_id=$venta->cliente_id;
        $this->codigo_interno=$venta->cliente->codigo_interno;
        $this->nombre_empresa=$venta->cliente->nombre_empresa;
        $this->nombres_cliente=$venta->cliente->nombres_cliente;
        $this->apellidos_cliente=$venta->cliente->apellidos_cliente;
        $this->correlativo=$venta->correlativo+1;
        $this->id_venta=$venta->id;
        $this->saldo_credito= $venta->saldo_total_venta;
        $this->cantidad_credito_actual=$venta->saldo_total_venta;
        $this->total_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;
    }

    public function updatedAsignarAbonoAnticipadoId($value)
    {
        $this->resetErrorBag('nuevo_saldo');
        $data=Abono::find($value);
        $this->no_abono=$data->no_abono;
        $this->cantidad_abono_asignar=$data->total_abono;
        $this->nuevo_saldo_asignar= $this->total_venta- $this->cantidad_abono_asignar;
        if($this->nuevo_saldo_asignar<0){
            $this->addError('nuevo_saldo', 'El abono no puede superar el credito total');
        }
    }

    public function storeAsignarAbonoAnticipado($value)
    {
        $this->validate(['asignar_abono_anticipado_id'=>'required','asignar_venta_id'=>'required']);
        if($this->nuevo_saldo_asignar<0){
            $this->addError('nuevo_saldo', 'El abono no puede superar el credito total');
        }else{

            $venta=Venta::find($this->asignar_venta_id);
            $venta->correlativo_abono+=1;
            $data = Abono::find($this->no_abono);
            $data->update([
                'venta_id'=>$venta->id,
                'fecha_abono_anticipado_asignado'=>$this->fecha_abono,
                'correlativo'=>$venta->correlativo_abono,
                'observaciones'=>"Abono Anticipado Asignado,$this->observaciones",
                'abono_anticipado_asignado'=>true,
            ]);
            $venta->abono=true;

            $venta->total_abono=$venta->total_abono+$data->total_abono;
            $venta->saldo_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;

            if($venta->total_credito==($venta->total_abono+$venta->total_nota_credito)){
                $venta->fecha_cancelado_total_venta=$this->fecha_abono;
                $venta->cancelado_total_venta=TRUE;

            }
            $venta->save();
            $this->isCreateAnticipadoAsignar=false;
        }
    }
    /////////////////////////


        public function show($rowId)
    {
        $this->disabled=true;
        $this->isShow=true;
        $data=Abono::find($rowId);

        if($data->abono_anticipado==true){
            $this->titulo_abono="Abono anticipado";
            $this->no_abono=$data->no_abono;
            $this->fecha_abono=$data->fecha_abono;
            $this->total_abono=$data->total_abono;
            $this->observaciones=$data->observaciones;
            $this->abono_anticipado=$data->abono_anticipado;
            $this->abono_anticipado_asignado=$data->abono_anticipado_asignado;
            $this->fecha_abono_anticipado_asignado=$data->fecha_abono_anticipado_asignado;

            $this->tipo_pago=$data->tipo_pago_id;
            $this->detalle_pago=$data->detalle_pago;
            $this->cliente_id=$data->cliente_id;
            $this->venta_id=$data->venta_id;
            $this->cliente_id=$data->cliente_id;

        }else{
            $this->titulo_abono="Abono";


            $this->no_abono=$data->no_abono;
            $this->fecha_abono=$data->fecha_abono;


            $this->no_venta=$data->venta->no_venta;
            $this->codigo_interno=$data->venta->cliente->codigo_interno;
            $this->nombre_empresa=$data->venta->cliente->nombres_empresa;
            $this->nombres_cliente=$data->venta->cliente->nombres_cliente;
            $this->apellidos_cliente=$data->venta->cliente->apellidos_cliente;
            $this->nombre_empresa=$data->venta->cliente->nombres_empresa;



            $this->total_venta=$data->total_venta;
            $this->total_nota_credito=$data->total_nota_credito;
            $this->total_abono=$data->total_abono;
            $this->saldo_credito=$data->cansaldo_credito;


            $this->cantidad_abono=$data->cantidad_abono;
            $this->nuevo_saldo=$data->nuevo_saldo;

            $this->observaciones=$data->observaciones;
            $this->detalle_pago=$data->detalle_pago;

            $this->abono_anticipado=$data->abono_anticipado;
            $this->abono_anticipado_asignado=$data->abono_anticipado_asignado;
            $this->fecha_abono_anticipado_asignado=$data->fecha_abono_anticipado_asignado;






            $this->tipo_pago=$data->tipo_pago_id;
            $this->detalle_pago=$data->detalle_pago;
            $this->cliente_id=$data->cliente_id;
            $this->venta_id=$data->venta_id;
            $this->cliente_id=$data->cliente_id;

        }

    }



//////////////////////////////////////////
    public function delete($rowId)
    {
        $data = Abono::find($rowId);
        $this->isDelete = true;
        $this->no_abono=$data->no_abono;
        $this->id_data=$data->id;
    }

    public function destroy($rowId)
    {
        $abono = Abono::find($rowId);

        if($abono->abono_anticipado==false && $abono->abono_anticipado_asignado==false){
            $venta=Venta::find($abono->venta_id);
            if($venta->anulado==false){
                $venta->correlativo-=1;
                $venta->total_abono-=$abono->total_abono;
                $venta->saldo_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;
                $venta->save();
                $abono->delete();
                $this->alertaNotificacion("destroy");
            }else{
               //dd("error abono normal no borrar por anulado");
                $this->alertaNotificacion("error");
            }
        }elseif($abono->abono_anticipado==true && $abono->abono_anticipado_asignado==false ) {
            //dd("anticipado/no asignado");
            $abono->delete();
            $this->alertaNotificacion("destroy");

        }elseif($abono->abono_anticipado==true && $abono->abono_anticipado_asignado==true){
            //dd("anticipado/y asignado");
            $venta=Venta::find($abono->venta_id);
            if($venta->anulado==false){
                //dd("anticipado/y asignado /// y no anuadooo");
                $venta->correlativo-=1;
                $venta->total_abono-=$abono->total_abono;

                $venta->saldo_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;

                $venta->save();
                $abono->delete();
                $this->alertaNotificacion("destroy");
            }else{
                $this->alertaNotificacion("error");
            }

        }

       // $this->alertaNotificacion("destroy");
        $this->cancel();
    }


    public function exportarFila($rowId)
    {
        $data_temp=Abono::find($rowId);
         $data=exportarFilaPDF('Abono', [
            'data' => $data_temp,
        ]);
        return $data;
    }

    public function cancel()
    {
        $this->dispatch('pg:eventRefresh-abonoTable');
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function cancelarBuscarVenta()
    {
        $this->isCreate=true;

        $this->reset(['isSearchVenta','search_no_venta','search_codigo_cliente','search_nombres_cliente','ventas','isSearchCliente']);
    }

    private function resetInputFields()
    {
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at','correlativo_abono']);
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito','no_abono','id']);
    }

    public function alertaNotificacion($tipo)
    {

        $alerta="";
        $title="";
        $texto="";
        if($tipo=="store"){

            $title="Agregar";
            $texto="Registro agregado";
            $alerta="success";

        }elseif($tipo=="update"){
            $title="Editar";
            $texto="Registro editado";
            $alerta="success";

        }elseif($tipo=="destroy"){
            $title="Borrar";
            $texto="Registro borrado";
            $alerta="success";
        }elseif($tipo=="error"){
            $title="Error";
            $texto="No se completo la operación";
            $alerta="error";
        }elseif($tipo=="errorCorrelativo"){
            $title="Error";
            $texto="No se completo la operación,existe operacion previa";
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
