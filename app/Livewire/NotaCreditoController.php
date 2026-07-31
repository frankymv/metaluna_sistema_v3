<?php

namespace App\Livewire;
use Illuminate\Support\Str;


use App\Models\EstadoCuenta;
use App\Models\NotaCredito;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;

class NotaCreditoController extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $title='Nota de Credito';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false,$disabledTotalNotaCredito=false;
    public $nuevo_saldo=0, $fecha_abono=null;
    public $anulacion_venta=false,$anulado=false;
    public $isSearchVenta=false;
    public $disabledForm=[];


    //cliente
    public $codigo_interno=null,$nombre_empresa=null,$nombres_cliente=null;

    //venta
    public $total_venta=0,$fecha_venta=null;
    public $saldo_cancelado=false;

    //notacredito
    public $id=null,$no_nota_credito=null,$total_total_nota_credito=0,$fecha_nota_credito=null,$cantidad_existencia=null;
    public $total_ventas=0,$total_abono=0,$total_nota_credito=0,$cantidad_nota_credito=0;

    public $venta_id=null,$cantidad_credito_actual=0,$cantidad_abono=0,$saldo_credito=0,$estado=0,$observaciones=null,$correlativo_nota_credito=0;
    public $tipo_pago=[['id'=>'0','nombre'=>'contado'],['id'=>'1','nombre'=>'credito'],['id'=>'2','nombre'=>'abono']];
    public $anulacion=false;

    public $ventas=[];

    public $search_no_venta,$search_nombres_cliente,$search_codigo_cliente;

        /////////filtros
        public $filtroNoNotaCredito=null;
        public $filtroNoVenta=null;
        public $filtroNombreCliente=null;
        public $filtroCodigoCliente=null;
        Public $filtroFechaNotaCredito=null;

        public $nota_creditos=[];

        public $no_venta=null,$apellidos_cliente=null;

        public $forma_pagos,$envios,$tipo_clientes,$rutas,$saldo_total_venta=0;
        public $abonos=[],$estado_cuentas=[];

        /////
        public $delete_no=null,$delete_nombre=null;
        public $filtroFecha=null;
        public $filtroFechaInicio=null;
        public $filtroFechaFin=null;

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required',
        'fecha_nota_credito'=>'required'
    ];

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


        $data_temp=NotaCredito::with('venta')->with('cliente')
        ->where('no_nota_credito','like',"%{$this->filtroNoNotaCredito}%")
        ->whereRelation('venta','no_venta','LIKE',"%{$this->filtroNoVenta}%")
        ->whereRelation('cliente','codigo_interno','LIKE',"%{$this->filtroCodigoCliente}%")
        ->whereRelation('cliente','nombres_cliente','LIKE',"%{$this->filtroNombreCliente}%")
        ->latest();

        if(!empty($this->filtroFecha)){
            $data_temp->whereBetween('fecha_nota_credito',[$this->filtroFechaInicio,$this->filtroFechaFin]);
        }

        $data_temp=$data_temp->paginate($this->per_page);


        $total_notas=NotaCredito::with('venta')->with('cliente')
        ->where('no_nota_credito','LIkE',"%{$this->filtroNoNotaCredito}%")
        ->whereRelation('venta','no_venta','LIKE',"%{$this->filtroNoVenta}%")
        ->whereRelation('cliente','codigo_interno','LIKE',"%{$this->filtroCodigoCliente}%")
        ->whereRelation('cliente','nombres_cliente','LIKE',"%{$this->filtroNombreCliente}%")
        ->latest();

        if(!empty($this->filtroFecha)){
            $total_notas->whereBetween('fecha_nota_credito',[$this->filtroFechaInicio,$this->filtroFechaFin]);
        }

        $this->total_total_nota_credito=$total_notas->sum('total_nota_credito');



        return view('livewire.pages.nota_credito.index', [
            'notass' => $data_temp,'total_notas'=>$total_notas
        ]);
    }

    public function create()
    {
        $this->disabled=true;

        $this->fecha_nota_credito=Carbon::now()->toDateString();
        $data=NotaCredito::latest()->first();
        if ($data) {
            $this->id=$data->id+1;
            $this->no_nota_credito=$this->id;
        }else{
            $this->id=1;
            $this->no_nota_credito=$this->id;
        }
        $this->isCreate=true;
    }

    public function buscarVenta()
    {
        $this->isSearchVenta=true;
        $this->isCreate=false;
    }

    public function updatedSearchNoVenta($value)
    {
        $this->reset(['search_nombres_cliente','search_codigo_cliente']);
        $this->ventas=Venta::with('cliente')
        ->where('no_venta','LIKE',"%{$value}%")
        ->get();
    }

    public function updatedSearchNombresCliente($value)
    {
        $this->reset(['search_no_venta','search_codigo_cliente']);


            $this->ventas=Venta::with('cliente')
            ->whereRelation('cliente','nombres_cliente','LIKE',"%{$value}%")
            ->get();


    }

    public function updatedSearchCodigoCliente($value)
    {
        $this->reset(['search_nombres_cliente','search_no_venta']);
        $this->ventas=Venta::with('cliente')
        ->whereRelation('cliente','codigo_interno','LIKE',"%{$value}%")
        ->get();

      //  dd($this->ventas);
    }


    public function updatedCantidadNotaCredito($value)
    {

        $this->nuevo_saldo=(($this->total_venta-$this->total_nota_credito)-$this->total_abono)-$value;
    }


    public function agregarVenta($id)
    {
        $this->cancelarBuscarVenta();
        $venta=Venta::find($id);

        $this->correlativo_nota_credito+=1;
        $this->no_venta=$venta->no_venta;

        $this->venta_id=$venta->id;
        $this->fecha_venta=$venta->fecha_venta;

        $this->total_venta=$venta->total_venta;
        $this->total_abono=$venta->total_abono;
        $this->total_nota_credito=$venta->total_nota_credito;
        $this->saldo_credito= ($this->total_venta-$this->total_nota_credito)-$this->total_abono;


        $this->codigo_interno=$venta->cliente->codigo_interno;
        $this->nombre_empresa=$venta->cliente->nombre_empresa;
        $this->nombres_cliente=$venta->cliente->nombres_cliente;
        $this->apellidos_cliente=$venta->cliente->apellidos_cliente;

    }
    public function cancelarBuscarVenta(){
        $this->isCreate=true;

        $this->reset(['isSearchVenta','search_no_venta','search_codigo_cliente','search_nombres_cliente','ventas']);
    }

    public function store(){

        $this->validate(['no_venta'=>'required','fecha_nota_credito'=>'required','total_nota_credito'=>"numeric|required|min:0"]);
        $data=NotaCredito::latest()->first();
        if ($data) {
            $this->id=$data->id+1;
            $this->no_nota_credito=$this->id;
        }else{
            $this->id=1;
            $this->no_nota_credito=$this->id;
        }

        $venta_temp=Venta::find($this->venta_id);
        $venta_temp->correlativo_nota_credito+=1;
        //al momento de anular una venta con una nota de credito
        if($this->anulacion_venta){


            NotaCredito::create(
                [
                    'no_nota_credito'=>$this->no_nota_credito,
                    'venta_id'=>$this->venta_id,
                    'fecha_nota_credito'=>$this->fecha_nota_credito,
                    'total_nota_credito'=>$this->cantidad_nota_credito,
                    'cliente_id'=>$venta_temp->cliente_id,
                    'correlativo'=>$venta_temp->correlativo_nota_credito,
                    'anulacion_venta'=>true,
                    'observaciones'=>"Anulacion de la Venta No. $this->venta_id, $this->observaciones",

                ]
            );
            foreach($venta_temp->productos as $key => $value){
                $cantidad_antes = DB::table('producto_sucursal')->where('producto_id','=',$value->id)->where('sucursal_id','=',$venta_temp->sucursal_id)->get();
                $can=(int)$cantidad_antes[0]->cantidad;
                $can=($can+$value->producto_venta->cantidad);
                DB::table('producto_sucursal')
                    ->where('producto_id','=', $value->id,)
                    ->where('sucursal_id','=',$venta_temp->sucursal_id)
                    ->update(['cantidad' => $can]);
                $producto_temp=Producto::find($value->id);
                $producto_temp->existencia+=$value->producto_venta->cantidad;
                $producto_temp->save();
            }

            $venta_temp->nota_credito=true;
            $venta_temp->anulado=true;
            $venta_temp->fecha_anulado=$this->fecha_nota_credito;
            $venta_temp->total_nota_credito=(($this->total_venta-$this->total_nota_credito)-$this->total_abono)-$this->cantidad_nota_credito;
            $venta_temp->save();
            $this->alertaNotificacion("store");

        }else{
           // dd(" para nota de credito normal");
            NotaCredito::create(
            [
                'no_nota_credito'=>$this->no_nota_credito,
                'venta_id'=>$this->venta_id,
                'fecha_nota_credito'=>$this->fecha_nota_credito,
                'total_nota_credito'=>$this->cantidad_nota_credito,
                'cliente_id'=>$venta_temp->cliente_id,
                'correlativo'=>$venta_temp->correlativo_nota_credito,
                'anulacion_venta'=>false,
                'observaciones'=>$this->observaciones,
            ]
            );

    };

            $venta_temp->nota_credito=true;
            $venta_temp->total_nota_credito+=$this->cantidad_nota_credito;
            $venta_temp->save();
            $this->alertaNotificacion("store");

    $this->cancel();
}


public function show($rowId){
    $this->disabled=true;
    $data=NotaCredito::find($rowId);


      $venta=Venta::find($data->venta_id);

        $this->correlativo_nota_credito+=1;
        $this->no_venta=$venta->no_venta;

        $this->venta_id=$venta->id;
        $this->fecha_venta=$venta->fecha_venta;

        $this->total_venta=$venta->total_venta;
        $this->total_abono=$venta->total_abono;
        $this->total_nota_credito=$venta->total_nota_credito;
        $this->saldo_credito= ($this->total_venta-$this->total_nota_credito)-$this->total_abono;


        $this->codigo_interno=$venta->cliente->codigo_interno;
        $this->nombre_empresa=$venta->cliente->nombre_empresa;
        $this->nombres_cliente=$venta->cliente->nombres_cliente;
        $this->apellidos_cliente=$venta->cliente->apellidos_cliente;





    $this->no_nota_credito=$data->no_nota_credito;
    $this->venta_id=$data->venta_id;
    $this->fecha_nota_credito=$data->fecha_nota_credito;
    $this->total_nota_credito=$data->cantidad_nota_credito;

    $this->anulacion_venta=$data->anulacion_venta;
    $this->observaciones=$data->observaciones;

    $this->isShow=true;

}





    public function exportarFila($rowId)
    {
        $data_temp=NotaCredito::find($rowId);
         $data=exportarFilaPDF('NotaCredito', [
            'data' => $data_temp,
        ]);
        return $data;
    }

    public function anulacionVenta(){
        if($this->anulado===true){
            $this->total_nota_credito=$this->total_venta;
            $this->disabled=true;
            $this->anulacion_venta=true;
            }else{
                $this->total_nota_credito=0;
            $this->disabled=false;
            $this->anulacion_venta=false;

            }
        }

    public function delete($rowId){

        $data = NotaCredito::find($rowId);

               if($data->anulacion_venta){
                $this->alert('error', 'No es posible borrar nota de credito de anulacion', [
                    'position' => 'center',
                    'timer' => '2000',
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                    'timerProgressBar' => true,
                    'text' => 'No es posible borrar una nota de credito de anulacion',
                ]);

               }else{
                $data_venta=Venta::find($data->venta_id);

                if($data->correlativo==$data_venta->correlativo){

                    $this->isDelete = true;
                    $this->delete_no=$data->no_nota_credito;
                    $this->delete_nombre=$data->total_nota_credito;
                    $this->id_data=$data->id;
                }else{
                    $this->alert('error', 'No es posible borrar', [
                        'position' => 'center',
                        'timer' => '2000',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'onConfirmed' => '',
                        'timerProgressBar' => true,
                        'text' => 'Existe una operacion anterior',
                    ]);
                };

               }



    }

    public function destroy($rowId)
    {
        $data = NotaCredito::find($rowId);
        $data_venta = Venta::find($data->venta_id);
        $this->correlativo_nota_credito-=1;

        $data_venta->update([
            'correlativo_nota_credito'=>$this->correlativo_nota_credito,
            'saldo_venta'=>($data->total_nota_credito+$data->total_saldo),
            'total_nota_credito'=>$data_venta->total_nota_credito-$data->total_nota_credito,
            'fecha_nota_credito'=>null
        ]);


        $data->delete();


        $this->alertaNotificacion("destroy");


        if(DB::table('estado_cuentas')->where('cliente_id',$data->cliente_id)->exists()){
            $estado_cuenta_temp=EstadoCuenta::where('cliente_id',$data->cliente_id)->first();
            $estado_cuenta=DB::table('estado_cuentas')
            ->where('cliente_id','=', $data->cliente_id)
            ->update(['total_abono' => $estado_cuenta_temp->total_abono+$data->total_nota_credito]);
        }else{
            $data=EstadoCuenta::create(
                [
                'cliente_id'=>$data->cliente_id,
                'total_abono'=>$data->total_nota_credito,
                'total_credito'=>0,
                ]
                );


        };


        $this->cancel();

    }



    public function cancel(){
        $this->dispatch('pg:eventRefresh-notaCreditoTable');
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at','correlativo_nota_credito']);
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito']);


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
