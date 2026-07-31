<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {




            Schema::create('asignacion_venta', function (Blueprint $table) {


                $table->unsignedBigInteger('asignacion_id');
                $table->foreign('asignacion_id')->references('id')->on('asignacions');
                $table->unsignedBigInteger('venta_id');
                $table->foreign('venta_id')->references('id')->on('ventas');






        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_venta');
    }
};
