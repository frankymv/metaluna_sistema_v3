<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use App\Constantes\DataSistema;
use App\Models\Abono;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\EstadoCuenta;
use App\Models\Marca;
use App\Models\Material;
use App\Models\Producto;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Venta;
use App\Models\Movimiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;

class VentaRapidaController extends Component
{
    use LivewireAlert;
    use WithPagination;
    use LivewireAlert;
    ///sistema
    public $title='Venta';
    public $data,   $id_data,$ultima_venta,$id=null;
    public $isCreate=false, $isAddProduct=false, $isSearchProduct=false, $isDetalleVenta=false,$isPrintVenta=false;
    ////venta
    public $no_venta=null,$fecha_venta=null, $sub_total=0.0,$total_venta=0.0,$observaciones_venta=null,$forma_pago=null,$saldo_venta=0;
    //cliente
    public $cliente_id=null,$codigo_interno=null,$codigo_mayorista=null, $nombre_empresa=null,$nombres_cliente=null, $apellidos_cliente=null, $tipo_cliente=null, $nit=null,$descuento=0,$direccion_fisica=null,$direccion_departamento=null,$direccion_municipio=null;
    //efectivo
    public $efectivo=false;
    //credito
    public $credito=false, $total_credito=0,$observaciones_credito='',$fecha_limite_credito=0,$limite_credito=0;
    //anuladoooo
    public $anulado=false, $fecha_anulado=null, $observaciones_anulado='';
    //nota de credito
    public $nota_credito=false, $no_credito=null,$total_nota_credito=0, $fecha_nota_credito=null,$observaciones_nota_credito='';
    //cancelado
    public $cancelado=false, $fecha_cancelado=null;
    public $nombre_venta='';
    ///statics
    public $envios=[],$forma_pagos=[],$tipos=[],$productos=[],$marcas=[],$materiales=[];
    public $nombresDetalle= [],$productosDetalle= [], $cantidadesDetalle= [],$subtotalDetalle= [],$total=0;
    //consultas
    public $proveedores=null;
    ///inputs bloqueo
    public $disabledInput=false,$disabled=false;
    public $dias_ultimo_credito=0;

    public $precio_final=0;
    public $dias_limite_credito=0;
    public $cantidad_credito=0;


    ///variables agregar cantidad
    //inputs bloqueo agregar cantidad
    public $disabled_precio_venta_producto=false;
    public $disabled_cantidad_producto=false;
    public $disabled_nombre_producto=false;
    public $disabled_nombre_venta_producto=false;
    public $disabled_existencia_producto=false;
    public $disabled_codigo_producto=false;
    public $disabled_subtotal_producto=false;

    public $precio_venta_producto=0.0,$cantidad_producto=0, $subtotal_producto=0.0;

    ////productooo
    public $contadorProductos=0;
    public $id_producto=null;
    public $codigo_producto=null;
    public $nombre_producto=null;
    public $existencia_producto=null;
    public $precio_venta_base=null;
    public $precio_unitario=0;
    public $venta_por_pie=false;
    public $longitud=0;

    public $temp=null;

    public $limite_credito_temp=null;


    //variables
    public $id_forma_pago="CREDI", $id_envio="SINENVIO", $estado_envio="NO/APLICA",$id_tipo=null, $id_marca=null, $id_material=null;



    //form
    public $buscar_nit='',$saldo_credito=0,$nuevo_saldo=0,$buscar_producto=null;

    //usuario para liberar credito
    public $liberar_credito_password=null;
    public $liberar_credito_usuario=null;
    public $autorizacion_limite_credito=false;

    public $cambioPrecio=false;


    public $isPie=false;

    protected $listeners=['edit', 'delete','show'];

    public $tipo_documento=null;
    public $no_abono=null;

    public $abono_anticipado=0;
//////////////liberar o desbloquear precio////

public $email_edit=null, $codigo_edit=null;

    /////////buscar cliente////////////
    public $isSearchCliente=false;
    public $clientes=[];
    public $search_nombres_cliente=null;
    public $search_codigo_cliente=null;
    public $search_nit_cliente=null;
    //////////////INDEX/////////////////

    /////ventana confirmacion detalle para pdf
    public $no_venta_detalle=null;
    public $total_venta_detalle=null;
    public $no_credito_detalle=null;
    public $nombres_cliente_detalle=null;
    public $apellidos_cliente_detalle=null;

    public function mount()
{
    $this->forma_pagos = DataSistema::$forma_pago;
    $this->envios = DataSistema::$envio;
    $this->fecha_venta = now()->toDateString();
    $ultimoNumero = Venta::max('no_venta');
    $this->no_venta = $ultimoNumero ? $ultimoNumero + 1 : 1;
    $this->disabledInput=true;

}

    public function render(){
        return view('livewire.pages.venta_rapida.index');
    }
    /////////////BUSCAR CLIENTES//////////////
    public function searchCliente(){
        $this->isSearchCliente=true;
    }

    public function updatedSearchNombresCliente($value){
        $this->reset(['search_codigo_cliente','search_nit_cliente']);
        $this->clientes=Cliente::where('nombres_cliente','like',"%$value%")->get();
    }



    public function updatedSearchCodigoCliente($value){
        $this->reset(['search_nombres_cliente','search_nit_cliente']);
        $this->clientes=Cliente::where('codigo_mayorista','like',"%$value%")->get();

    }
    public function updatedSearchNitCliente($value){
        $this->reset(['search_nombres_cliente','search_codigo_cliente']);
        $this->clientes=Cliente::where('nit','like',"%$value%")->get();
    }

    /////////////////////// AGREAGR CLIENTE//////////
    public function agregarCliente($id){

        $cliente=Cliente::find($id);
        $total_cre=Venta::where('cliente_id',$cliente->id)->where('credi','1')->sum('total_credito');
        $total_abo=Venta::where('cliente_id',$cliente->id)->where('credi','1')->sum('total_abono');
        $this->abono_anticipado=Abono::where('cliente_id','=',$cliente->id)->where('abono_anticipado','=',1)->where('abono_anticipado_asignado','=',0)->sum('total_abono');
        $this->saldo_credito=$total_cre-$total_abo;

        $this->nuevo_saldo=($this->saldo_credito+$this->sub_total)-$this->abono_anticipado;

        $this->cliente_id= $cliente->id;


        $this->codigo_interno= $cliente->codigo_interno;
        $this->codigo_mayorista= $cliente->codigo_mayorista;
        $this->nombre_empresa= $cliente->nombre_empresa;
        $this->nombres_cliente= $cliente->nombres_cliente;
        $this->apellidos_cliente= $cliente->apellidos_Cliente;
        $this->dias_limite_credito=$cliente->dias_limite_credito;
        $this->nit= $cliente->nit;
        $this->descuento= $cliente->descuento;
        $this->direccion_fisica= $cliente->direccion_fisica;
        $this->direccion_departamento= $cliente->direccion_departamento;
        $this->direccion_municipio= $cliente->direccion_municipio;
        $this->limite_credito=$cliente->limite_credito;
        $this->dias_ultimo_credito=$cliente->dias_limite_credito;
        $this->tipo_cliente=$cliente->tipo_cliente;


        $this->alert('success', 'Cliente encontrado', [
            'position' => 'center',
            'timer' => '3000',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            ]);
        $this->reset(['isSearchCliente','search_nombres_cliente','search_codigo_cliente','search_nit_cliente','clientes']);
    }

    public function cancelarBuscarCliente(){
        $this->reset(['isSearchCliente','search_nombres_cliente','search_codigo_cliente','search_nit_cliente','clientes']);
    }

    //////////////// BOTON BUSCAR PRODUCTO ////////////////////

    public function buscarProducto(){
        //$this->bandera=$this->bandera+1;
        $this->tipos=Tipo::all();
        $this->marcas=Marca::all();
        $this->materiales=Material::all();
        $this->reset(['productos','id_tipo']);
        $this->isSearchProduct=true;

    }

    public function updatedBuscarProducto($value){
        $this->reset(['productos','id_tipo','id_marca','id_material']);
        $this->productos=Producto::where('nombre','LIKE',"%{$value}%")->get();
    }

    public function updatedIdTipo($value){
        $this->reset(['buscar_producto','productos','id_marca','id_material']);
        $this->productos=Producto::query()
        ->where('tipo_id',$value)
        ->get();
    }
    public function updatedIdMarca($value){
        $this->reset(['buscar_producto','productos','id_tipo','id_material']);
        $this->productos=Producto::query()
        ->where('marca_id',$value)
        ->get();
    }
    public function updatedIdMaterial($value){
        $this->reset(['buscar_producto','productos','id_tipo','id_marca']);
        $this->productos=Producto::query()
        ->where('material_id',$value)
        ->get();
    }

    public function cancelBuscarProducto(){
        $this->reset(['buscar_producto','productos','id_tipo','id_marca','isSearchProduct']);
        $this->resetValidation();
    }

    //////////////// AGREGAR CANTIDAD PRODUCTO////////////////////

    public function updatedPrecioVentaProducto($value){
        $this->cantidad_producto=0;
        $this->subtotal_producto=0.0;
    }


//ventana para agregar cantidad de producto
    public function agregarCantidadProducto($id){
    //dd("aca");
        $this->reset(['buscar_producto','productos','id_tipo','id_marca','isSearchProduct']);
        $productos=Producto::find($id);
        $this->disabled_precio_venta_producto=true;
        $this->disabled_cantidad_producto=false;
        $this->disabled_nombre_producto=true;
        $this->disabled_nombre_venta_producto=true;
        $this->disabled_existencia_producto=true;
        $this->disabled_codigo_producto=true;
        $this->disabled_subtotal_producto=true;
        $this->isAddProduct=true;
        if($productos->tipo_id===9)
        {
            $this->isPie=true;
        }
        $this->venta_por_pie=$productos->divisible;
        $this->longitud=$productos->longitud;
        $this->id_producto=$productos->id;
        $this->codigo_producto=$productos->codigo;
        $this->nombre_producto=$productos->nombre;
        $this->nombre_venta=$productos->nombre_venta;
        $this->existencia_producto=$productos->existencia;
        $this->precio_unitario=$productos->precio_unitario;
        $this->precio_final = number_format((float)$productos->precio_final, 2);
    }

    public function updatedCantidadProducto($value){
        $this->validate(['cantidad_producto'=>"numeric|required|min:1|max:$this->existencia_producto"]);
        if(!$value){
            $value=0;
        }
        if ($this->cantidad_producto>$this->existencia_producto) {
            $this->subtotal_producto=number_format((float)0, 2);
            $this->addError('agregar_producto', 'La cantidad supera a la existencia actual');
        }else{
            $precio = $this->toFloat($this->precio_final);
            $cantidad = $this->cantidad_producto;
            //$this->subtotal_producto = $precio * $cantidad;
            $this->subtotal_producto = round($precio * $cantidad, 2);
        };
    }

    public function updatedPrecioUnitario($value){
        $this->cambioPrecio=true;
        $precio = $this->toFloat($value);
        $cantidad = $this->toFloat($this->longitud);
        $this->precio_final = ($precio * $this->longitud );
        $this->subtotal_producto = $this->precio_final * $cantidad;

        $this->reset(['cantidad_producto','subtotal_producto']);
    }

    public function updatedPrecioFinal($value){
        $this->cambioPrecio=true;
        $precio = $this->toFloat($value);
        $cantidad = $this->toFloat($this->cantidad_producto);
        $this->subtotal_producto = $precio * $cantidad;
    }

    public function updatedIdEnvio($value){
        if($value!="SINENVIO"){
            $this->estado_envio="SIN ASIGNAR";
        }else{
            $this->estado_envio="NO APLICA";
        }
    }

    ////// al momento de confirmar cantidad
    public function agregarDetalle($id){
        $this->subtotal_producto = str_replace(',', '', $this->subtotal_producto);
        $this->abono_anticipado = str_replace(',', '', $this->abono_anticipado);
        //dd($this->subtotal_producto);
        $this->resetValidation('limite_credito');
        $this->validate(['subtotal_producto'=>'required',
        'cantidad_producto'=>"numeric|required|min:1|max:$this->existencia_producto"]);

        $this->productos=Producto::query()
        ->where('id','=',$id)
        ->get();




        $datatempproducto=[];
        foreach ($this->productos as $key => $value) {
            if($value['id']===intval($this->id_producto)){

                $datatempproducto=$value->attributesToArray();
                $datatempproducto+=['precio_final_venta'=>$this->precio_final];
                $datatempproducto+=['cantidad_producto'=>$this->cantidad_producto];
                $datatempproducto+=['subtotal_producto'=>$this->subtotal_producto];
                array_push($this->productosDetalle,$datatempproducto);
                $this->sub_total+=$this->subtotal_producto;
                $this->toFloat($this->sub_total) ;
                $this->toFloat($this->subtotal_producto);
                $this->nuevo_saldo=$this->saldo_credito+$this->sub_total;
                $this->contadorProductos+=1;
                //dd($this->productosDetalle);
            }
        }

        if ($this->id_forma_pago==="CREDI") {
            $this->nuevo_saldo=$this->saldo_credito+$this->sub_total;
        }
        $precio = $this->toFloat($this->precio_final);
        $cantidad = $this->toFloat($this->cantidad_producto);

        $this->subtotal_producto = $precio * $cantidad;
        $total_cre=Venta::where('cliente_id',$this->cliente_id)->where('credi','1')->sum('total_credito');
        $total_abo=Venta::where('cliente_id',$this->cliente_id)->where('credi','1')->sum('total_abono');
        $this->abono_anticipado=Abono::where('cliente_id','=',$this->cliente_id)->where('abono_anticipado','=',1)->where('abono_anticipado_asignado','=',0)->sum('total_abono');
        $this->saldo_credito=$total_cre-$total_abo;
        $this->nuevo_saldo=($this->saldo_credito+$this->sub_total)-$this->abono_anticipado;
        $this->cancelProductQuantity();
        $this->alert('success', 'Producto Agregado', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
            'timerProgressBar' => true,
           ]);
    }

    public function removeDetalle($i){
        $this->resetValidation('limite_credito');
        $this->sub_total=$this->sub_total-$this->productosDetalle[$i]['subtotal_producto'];
        $this->nuevo_saldo=$this->sub_total-$this->saldo_credito;
        unset($this->productosDetalle[$i]);
        $this->contadorProductos-=1;
    }


    public function store(){
        $this->validate([
            'id_forma_pago'=>'required',
            'id_envio'=>'required',
            'contadorProductos'=>'required|numeric|min:1',
            'nombres_cliente'=>'required',
            'dias_ultimo_credito'=>'required|numeric|min:0']);

        $cliente=Cliente::find($this->cliente_id);
        $total_abono_anticipado=Movimiento::where('cliente_id','=',$cliente->id)->where('tipo_movimiento','=','abono_anticipado')->sum('total_movimiento');

        //$total_abono_anticipado=Abono::where('cliente_id','=',$cliente->id)->where('abono_anticipado','=',1)->where('abono_anticipado_asignado','=',0)->sum('total_abono');

        $totales = Venta::where('cliente_id', $this->cliente_id)->where('credi', 1)
            ->selectRaw('
                COALESCE(SUM(total_credito),0) as total_credito,
                COALESCE(SUM(total_abono),0) as total_abono,
                COALESCE(SUM(total_nota_credito),0) as total_nota_credito
            ')->first();

        $total_cre = $totales->total_credito;
        $total_abo = $totales->total_abono;
        $total_nota_cred = $totales->total_nota_credito;

        $saldoAnterior = ($total_cre - $total_nota_cred)- $total_abo;
        $nuevoSaldo = $saldoAnterior + $this->sub_total;


        $ultimoNumero=Venta::max('no_venta');
        $this->no_venta = $ultimoNumero ? $ultimoNumero + 1 : 1;

        $data= new Venta();
        $data->fill([
            'no_venta' => $this->no_venta,
            'fecha_venta' => $this->fecha_venta,
            'total_venta' => $this->sub_total,
            'salvo_venta' => 0,
            'observaciones_venta' => $this->observaciones_venta,
            'forma_pago_venta' => $this->id_forma_pago,
            'envio' => $this->id_envio,
            'estado_envio' => $this->estado_envio,
            'cliente_id' => $cliente->id,
            'sucursal_id' => Auth::user()->sucursal_id,
        ]);

       if($this->id_forma_pago==="CREDI" ) {

            if ($nuevoSaldo >= $cliente->limite_credito &&
                !$this->autorizacion_limite_credito) {
                $this->alertaNotificacion("credito_alto");
                return;
            }

            $data->fill([
                'credi'=>true,
                'total_credito'=>$this->sub_total,
                'saldo_venta' => $this->sub_total,
                'fecha_limite_credito' => Carbon::parse($this->fecha_venta)
                    ->addDays($cliente->dias_limite_credito)
                    ->format('Y-m-d'),
                'anticipo_v'=>$total_abono_anticipado,
                'saldo_anterior_v' => $saldoAnterior,
                'nuevo_saldo_v' => $nuevoSaldo,
            ]);

            $data->save();

                 $mov=Movimiento::latest()->first();
                if ( $mov) {
                    $this->id=$mov->id+1;
                    $this->codigo=$this->id;
                }else{
                    $this->id=1;
                    $this->codigo=$this->id;
                }


              $movimiento = new Movimiento();
                $movimiento->fill([
                    'no_movimiento' => $this->id,
                    'fecha_movimiento' => $this->fecha_venta,
                    'total_movimiento' => $this->sub_total,
                    'observaciones' => $this->observaciones_venta,
                    'tipo_movimiento' => 'credito',
                    'tipo_pago' => '',
                    'venta_id' => $this->no_venta,
                    'cliente_id' => $cliente->id,
                ]);
            $movimiento->save();
        }else{
              $data->save();
        }


        foreach ($this->productosDetalle as $key => $value) {
            $data->productos()->attach($value['id'],['cantidad' => $value['cantidad_producto'],'precio_venta' => $value['precio_final_venta'],'sub_total' => $value['subtotal_producto']]);
        }
        $this->alertaNotificacion("store");
        $this->dispatch('venta-completada', [
        'pdf' => route('exportarVentaRapida', $data->id),
        'redirect' => route('venta_rapida'),
        ]);
    }

    public function liberarCredito(){
        if(User::where('email',$this->email_edit)->where('codigo_credito', $this->codigo_edit)->first()){
            $this->autorizacion_limite_credito=true;
            $this->alert('success', "Limite autorizado", [
                'position' => 'center',
                'timer' => '3000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'timerProgressBar' => true,
               ]);
        }else{
            $this->alert('error', "Limite No autorizado", [
                'position' => 'center',
                'timer' => '3000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'timerProgressBar' => true,
               ]);

        }
    }

    ////////////////////////////PDF//////////////////////////
    public function cancel(){
        $this->dispatch('pg:eventRefresh-');        $this->reset();
        $this->cancelarBuscarProducto();
        $this->cancelProductQuantity();
    }

    public function exportarVentaRapida($id)
        {
            //dd($id);
            $venta=Venta::with('productos')->where('id',$id)->get()->first()->toArray();
            $cliente=Cliente::find($venta['cliente_id'])->toArray();
            $pdf = PDF::loadView('/livewire/pdf/fila/Venta',['venta' => $venta,'cliente'=>$cliente]);
            return $pdf->stream('venta.pdf',array("Attachment" => false));
        }


    public function exportarFila($id)
    {
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $venta=Venta::with('productos')->where('id',$rowId)->get()->first()->toArray();
        $cliente=Cliente::find($venta['cliente_id'])->toArray();

        $pdf = Pdf::loadView('/livewire/pdf/fila/Venta',['venta' => $venta,'cliente'=>$cliente]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }



    public function cancelarBuscarProducto(){
        $this->reset(['isSearchProduct','buscar_producto','id_tipo','tipos','marcas','id_marca','materiales','id_material','productos']);
        $this->resetValidation();
    }

    public function cancelProductQuantity(){
        $this->reset(['email_edit','codigo_edit']);
        $this->reset(['isAddProduct','codigo_producto','isPie','nombre_producto','existencia_producto','precio_venta_producto','cantidad_producto','subtotal_producto']);
        $this->resetValidation();
    }

    public function borrarTodo(){
        $this->reset();
        $this->resetValidation();
        $this->alert('success', 'Datos Borrados', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            'text' => 'Datos borrados correctamente',
           ]);
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
        }elseif($tipo==="credito_alto"){
            $title="Error";
            $texto="Supera el credito autorizado";
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

    private function toFloat($value): float
    {
        if ($value === null || $value === '') {
            return 0.0;
        }

        // quitar separadores de miles
        $value = str_replace(',', '', $value);

        return (float) $value;
    }

    private function money($value): string
    {
        return number_format((float)$value, 2, '.', ',');
    }

    public function updated($propertyName){
        if (in_array($propertyName, ['precio_final', 'cantidad_producto'])) {

            $precio = $this->toFloat($this->precio_final);
            $cantidad = $this->toFloat($this->cantidad_producto);

            $this->subtotal_producto = $precio * $cantidad;
        }

        if ($propertyName ==="id_forma_pago" && $this->id_forma_pago ==="CREDI") {


        $this->nuevo_saldo = $this->sub_total+$this->saldo_credito;
        }
          if ($propertyName ==="id_forma_pago" && $this->id_forma_pago ==="EFECT") {
            $this->nuevo_saldo=0;

        }
    }
}

