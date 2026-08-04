<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\EstadoCuenta;
use App\Models\Ruta;
use App\Models\Venta;
use Livewire\Component;
//use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;


class EstadoCuentaController extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $title='Estado Cuenta Cliente';
    public $data, $per_page=10,  $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isAddProduct=false,$disabled_nombre_producto=false,$disabled_existencia_producto=false,$disabled_codigo_producto=false,$disabled_subtotal_producto=false;



    public $ventas=[];

    public $data_temp;

    public $filtroCodigoCliente=null;
    public $filtroNombresCliente=null;
    public $filtroClientes=null;
    public $filtroTipoCliente=null;
    public $filtroRutaCliente=null;
    public $clienteId;



    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;
    public $clientes=[];

    public $fecha_actual;

    protected $listeners=['showDetalle','exportarFila'];

    public function mount()
    {
    }

    public function render()
    {
        $this->clientes=Cliente::all();
        $this->fecha_actual=Carbon::now()->toDateString();

        $prob = Cliente::where('nombres_cliente','LIkE',"%{$this->filtroNombresCliente}%")
                    ->where('nombres_cliente','LIkE',"%{$this->filtroNombresCliente}%")
        ->with(['ventas' => function ($query) {
            $query->where('cancelado_total_venta', 0);

        }])->with(['abonos' => function ($query) {
            $query->where('abono_anticipado', 1);
        }])->get();



        return view('livewire.pages.estado_cuenta.index', [
            'estado_cuentas' => $prob,
        ]);
    }

    public function borrarFiltros()
    {
        $this->reset();
    }


/*
    public function exportarGeneral()
    {
        $prob = Cliente::with(['ventas' => function ($query) {
            $query->where('cancelado_total_venta', 0);
        }])->with(['abonos' => function ($query) {
            $query->where('abono_anticipado', 1);
        }])->get();
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfEstadoCuentaClienteGeneral',['estados' => $prob]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
        }, "$this->title-$fecha_reporte.pdf");

    }
*/
/*
    public function exportarFila($rowId)
    {
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $venta=Venta::with('cliente')->where('id',$rowId)->get()->first()->toArray();
        $cliente=Cliente::find($venta['cliente_id'])->toArray();

        $pdf = Pdf::loadView('/livewire/pdf/fila/EstadoCuentaCliente',['venta' => $venta,'cliente'=>$cliente]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }
*/
        public function exportarFila($rowId)
    {
        $data_temp=Venta::find($rowId);
        $data=exportarFilaPDF('EstadoCuentaCliente', [
            'data' => $data_temp,
        ]);
        return $data;
    }










    public function exportarGeneral( $id )
    {
        $temp_al_dia=collect([]);
        $temp_30=collect([]);
        $temp_60=collect([]);
        $temp_90=collect([]);
        $temp_120=collect([]);
        $temp_actual=Carbon::now();

        $total_credito_al_dia=0;
        $total_credito_30=0;
        $total_credito_60=0;
        $total_credito_90=0;
        $total_credito_120=0;

            $cliente=Cliente::find($id);
            $estado_cuenta=EstadoCuenta::where('cliente_id','=',$id)->first();

           //dd( );
            $data_temp=Credito::with('venta')->where('cliente_id',$id)->where('activo',true)->get();
            //$data_temp=Venta::with('credito')->where('cliente_id',$id)->where('cancelado_total_venta',false)->get();


            $temp_actual=Carbon::now();

            foreach ($data_temp as $key => $value) {

                if ($temp_actual->diffInDays($value->fecha_limite_credito)>=0) {

                    $temp_al_dia->push($value->venta);
                    $total_credito_al_dia+=($value->venta->total_credito-$value->venta->total_nota_credito)-$value->venta->total_abono;
                }
                elseif ($temp_actual->diffInDays($value->fecha_limite_credito)>=-30) {
                    $temp_30->push($value->venta);
                    $total_credito_30+=($value->venta->total_credito-$value->venta->total_nota_credito)-$value->venta->total_abono;
                }elseif ($temp_actual->diffInDays($value->fecha_limite_credito)>=-60){
                    $temp_60->push($value->venta);
                    $total_credito_60+=($value->venta->total_credito-$value->venta->total_nota_credito)-$value->venta->total_abono;
                }elseif ($temp_actual->diffInDays($value->fecha_limite_credito)>=-90){
                    $temp_90->push($value->venta);
                    $total_credito_90+=($value->venta->total_credito-$value->venta->total_nota_credito)-$value->venta->total_abono;
                }else{
                    $temp_120->push($value);
                    $total_credito_120+=($value->venta->total_credito-$value->venta->total_nota_credito)-$value->venta->total_abono;
                }
            }


            $fecha_reporte=Carbon::now()->toDateTimeString();
            $pdf = Pdf::loadView('/livewire/pdf/pdfEstadoCuentaCliente',
            ['estado_cuenta'=>$estado_cuenta,
            'cliente' => $cliente,
            'credito_al_dia' => $temp_al_dia,
            'credito_30' => $temp_30,
            'credito_60' => $temp_60,
            'credito_90' => $temp_90,
            'credito_120' => $temp_120,

            'total_credito_al_dia'=>$total_credito_al_dia,

            'total_credito_30'=>$total_credito_30,
            'total_credito_60'=>$total_credito_60,
            'total_credito_90'=>$total_credito_90,
            'total_credito_120'=>$total_credito_120,
        ]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->setPaper('leter', 'landscape')->stream();
                }, "$this->title-$fecha_reporte.pdf");
    }
}
