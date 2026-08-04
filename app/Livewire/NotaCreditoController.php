<?php
namespace App\Livewire;

use App\Models\NotaCredito;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use Carbon\Carbon;

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
    public $anulacion_venta=false;
    public $isSearchVenta=false;
    public $disabledForm=[];
    public $anulado=false;

    //cliente
    public $codigo_interno=null,$nombre_empresa=null,$nombres_cliente=null;
    public $disabledAnulado=false;
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


    public function render()
    {
        return view('livewire.pages.nota_credito.index');
    }

    public function create()
    {
        $this->disabled=true;
        $this->disabledAnulado=false;

        $this->fecha_nota_credito=Carbon::now()->toDateString();
        $this->no_nota_credito=NotaCredito::siguienteNoRegistro();
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
        $no_nota_credito=NotaCredito::siguienteNoRegistro();

        $venta=Venta::find($this->venta_id);
        $venta->correlativo+=1;
        //al momento de anular una venta con una nota de credito
       
        if($this->anulado==='true'){
             NotaCredito::create(
                [
                    'no_nota_credito'=>$no_nota_credito,
                    'venta_id'=>$this->venta_id,
                    'fecha_nota_credito'=>$this->fecha_nota_credito,
                    'total_nota_credito'=>$venta->total_venta,
                    'cliente_id'=>$venta->cliente_id,
                    'correlativo'=>$venta->correlativo,
                    'anulacion_venta'=>true,
                    'observaciones'=>"Anulacion de la Venta No. $this->venta_id, $this->observaciones",
                ]);

            foreach($venta->productos as $key => $value){
                $cantidad_antes = DB::table('producto_sucursal')->where('producto_id','=',$value->id)->where('sucursal_id','=',$venta->sucursal_id)->get();
                $can=(int)$cantidad_antes[0]->cantidad;
                $can=($can+$value->producto_venta->cantidad);
                DB::table('producto_sucursal')
                    ->where('producto_id','=', $value->id,)
                    ->where('sucursal_id','=',$venta->sucursal_id)
                    ->update(['cantidad' => $can]);
                $producto_temp=Producto::find($value->id);
                $producto_temp->existencia+=$value->producto_venta->cantidad;
                $producto_temp->save();
            }

            $venta->nota_credito=true;
            $venta->anulado=true;
            $venta->fecha_anulado=$this->fecha_nota_credito;
            $venta->total_nota_credito=(($this->total_venta-$this->total_nota_credito)-$this->total_abono)-$this->cantidad_nota_credito;
            $venta->saldo_venta=0;
            $venta->save();
            $this->alertaNotificacion("store");
        }else{
            NotaCredito::create(
            [
                'no_nota_credito'=>$no_nota_credito,
                'venta_id'=>$this->venta_id,
                'fecha_nota_credito'=>$this->fecha_nota_credito,
                'total_nota_credito'=>$this->cantidad_nota_credito,
                'cliente_id'=>$venta->cliente_id,
                'correlativo'=>$venta->correlativo,
            ]);
        };
        $venta->nota_credito=true;
        $venta->total_nota_credito+=$this->cantidad_nota_credito;

        $venta->saldo_venta=($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono;
        $venta->save();
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

        $nota_credito = NotaCredito::find($rowId);

               if($nota_credito->anulacion_venta){
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
                $venta=Venta::find($nota_credito->venta_id);
                if($nota_credito->correlativo==$venta->correlativo){

                    $this->isDelete = true;
                    $this->delete_no=$nota_credito->no_nota_credito;
                    $this->delete_nombre=$nota_credito->total_nota_credito;
                    $this->id_data=$nota_credito->id;
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
        $nota_credito = NotaCredito::find($rowId);
        $venta = Venta::find($nota_credito->venta_id);
        $venta->correlativo-=1;

        $venta->update([
            'total_nota_credito'=>$venta->total_nota_credito-$nota_credito->total_nota_credito,
            'saldo_venta'=>($venta->total_venta-$venta->total_nota_credito)-$venta->total_abono,
            'fecha_nota_credito'=>null
        ]);
        $nota_credito->delete();
        $this->alertaNotificacion("destroy");
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
