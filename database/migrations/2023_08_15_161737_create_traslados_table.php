<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 2023081504
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('traslado_no');
            $table->date('traslado_fecha');
            $table->unsignedBigInteger('sucursal_origen_id')->nullable(true);
            $table->foreign('sucursal_origen_id')->references('id')->on('sucursals');
            $table->unsignedBigInteger('sucursal_destino_id')->nullable(true);
            $table->foreign('sucursal_destino_id')->references('id')->on('sucursals');
            $table->boolean('estado')->nullable(true);
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
        Schema::dropIfExists('traslados');
    }
};
