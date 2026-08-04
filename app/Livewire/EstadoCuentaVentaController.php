<?php

namespace App\Livewire;

use App\Models\Venta;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class EstadoCuentaVentaController extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $title='Estado Cuenta Venta';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    public $venta_id=null,$cantidad_credito_actual=null,$cantidad_abono=null,$saldo_credito=null,$estado=0;
    public $tipo_pago=[['id'=>'0','nombre'=>'contado'],['id'=>'1','nombre'=>'credito'],['id'=>'2','nombre'=>'abono']];


    public $ventas_credito=null;
    protected $listeners=['edit', 'delete','showDetalle','exportarFila'];

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required'
    ];

    public $ventas=[];

    public $filtroNoVenta;
    public $filtroCodigoCliente=NULL;
    public $filtroNombreCliente;
    public $filtroFecha;
    public $filtroRuta;
    public $filtroFormaPago;
    public $filtroEnvio;
    public $filtroTipoCliente;
    public $filtroRutaCliente=null;

    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;

    /////////////////////

    public function render()
    {
        return view('livewire.pages.estado_cuenta_venta.index');
    }

    public function exportarGeneral()
    {
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfEstadoCuentaVentaGeneral',['ventas' => $this->ventas,'total_ventas'=>$this->total_ventas]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }



        public function exportarFila($rowId)
    {
        $data_temp=Venta::find($rowId);
        $data=exportarFilaPDF('EstadoCuentaVenta', [
            'data' => $data_temp,
        ]);
        return $data;
    }





    public function cancel(){
        $this->dispatch('pg:eventRefresh-');        
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito']);


    }
}
