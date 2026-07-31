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
        Schema::create('salidas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('venta_id')->nullable(true);
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->unsignedBigInteger('producto_venta_id')->nullable(true);
            $table->foreign('producto_venta_id')->references('id')->on('producto_venta');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->integer('cantidad')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas');
    }
};
