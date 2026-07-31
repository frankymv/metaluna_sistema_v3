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
        Schema::create('ajuste_inventarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date('fecha_ajuste_inventario');
            $table->string('ajuste_inventario_no',250);
            $table->unsignedBigInteger('producto_id')->nullable(true);
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->string('tipo_ajuste');
            $table->string('descripcion',250)->nullable();
            $table->integer('cantidad_traslado')->nullable();
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
        Schema::dropIfExists('ajuste_inventarios');
    }
};
