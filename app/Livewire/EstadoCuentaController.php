<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Venta;
use Livewire\Component;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;



class EstadoCuentaController extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $title='Estado Cuenta Cliente';
    public $venta=[];
    public $data, $per_page=10,  $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isAddProduct=false,$disabled_nombre_producto=false,$disabled_existencia_producto=false,$disabled_codigo_producto=false,$disabled_subtotal_producto=false;
    public $idTodos=0;
    public $ventas=[];
    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;
    public $clientes=[];
    public $fecha_actual;
    public $total_credito=0;
        public $total_abono=0;
            public $total_nota_credito=0;
                public $saldo_actual=0;


    
    protected $listeners=['create','edit', 'delete','show','exportarFila'];


    public function render()
    {
        $this->clientes=Cliente::all();
        $this->fecha_actual=Carbon::now()->toDateString();
        return view('livewire.pages.estado_cuenta.index');
    }

    public function show($rowId)
    {
        //dd($rowId);
        $this->isShow=true;
        $this->venta=Venta::find($rowId);
        //dd($this->venta);

    }

    public function cancel(){
        $this->dispatch('pg:eventRefresh-');        
        $this->reset();
        $this->resetValidation();
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
}