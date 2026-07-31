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
        Schema::create('cotizacion_producto', function (Blueprint $table) {
            $table->id()->autoIncrement();

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');


            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
            $table->integer('precio_venta')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('cantidad')->nullable();
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
        Schema::dropIfExists('cotizacion_producto');
    }
};
