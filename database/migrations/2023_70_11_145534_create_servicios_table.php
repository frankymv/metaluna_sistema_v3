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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('no_servicio');
            $table->date('fecha_servicio');
            $table->float('total_servicio');
            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->string('descripcion')->nullable(true);
            $table->string('observaciones')->nullable(true);
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
        Schema::dropIfExists('servicios');
    }
};
