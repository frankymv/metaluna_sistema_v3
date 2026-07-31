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
        Schema::create('compras', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('compra_no');
            $table->string('no_recibo_compra');
            $table->date('compra_fecha');
            $table->unsignedBigInteger('proveedor_id')->nullable(true);
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

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
        Schema::dropIfExists('compras');
    }
};
