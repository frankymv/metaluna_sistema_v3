<?php
// app/Helpers/app_helpers.php

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;



if (!function_exists('formatearMoneda')) {
    /**
     * Descripción de la función.
     */
    function formatearMoneda($valor, $simbolo = 'Q') {
        return $simbolo . number_format($valor, 2);
    }
}




if (!function_exists('exportarGeneralPDF')) {
    /**
     * Exporta registros de forma general.
     */
    function exportarGeneralPDF($titulo,$datos=[]) {

        $fecha_reporte=Carbon::now()->toDateTimeString();
         $pdf = Pdf::loadView("livewire/pdf/general/{$titulo}",$datos);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('letter', 'landscape')->stream();
            }, "$titulo-General-$fecha_reporte.pdf");
    }
}


if (!function_exists('exportarFilaPDF')) {
    /**
     * Exporta registros de forma general.
     */
    function exportarFilaPDF($titulo,$data=[]){
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView("/livewire/pdf/fila/{$titulo}",$data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('letter')->stream();
            }, "$titulo-$fecha_reporte.pdf");
    }
}
/*
if (!function_exists('alertaNotificacion')) {

    function alertaNotificacion($tipo){
        $alert="";
        $title="";
        $texto="";
        if($tipo==="store"){
            $title="Agregar";
            $texto="Registro agregado";
            $alert="success";

        }elseif($tipo==="update"){
            $title="Editar";
            $texto="Registro editado";
            $alert="success";

        }elseif($tipo==="destroy"){
            $title="Borrar";
            $texto="Registro borrado";
            $alert="success";
        }elseif($tipo==="error"){
            $title="Error";
            $texto="No se completo la operación";
            $alert="error";
        }elseif($tipo==="23000"){
            $title="Error";
            $texto="El registro esta asociado a otro registro";
            $alert="error";
        }
        return session()->flash("$alert", "$title", [
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
*/
