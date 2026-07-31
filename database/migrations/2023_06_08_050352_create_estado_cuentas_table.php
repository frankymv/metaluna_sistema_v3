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
        //Schema::create('estado_cuentas', function (Blueprint $table) {
            /* $table->id()->autoIncrement();
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->float('total_abono')->default(0)->nullable(true);
            $table->float('total_credito')->default(0)->nullable(true);
            $table->string('observaciones')->nullable(true);

            $table->unsignedBigInteger('venta_id')->nullable(true);
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->string('tipo_transaccion');
            $table->string('detalle_transaccion');
            $table->string('tipo_estado_cuenta');
            $table->integer('cantidad');
            $table->dateTime('fecha');
            */
            //$table->timestamps();
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_cuentas');
    }
};
