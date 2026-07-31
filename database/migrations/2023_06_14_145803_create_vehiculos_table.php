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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo')->unique();
            $table->string('tipo_vehiculo');
            $table->string('tipo_placa');
            $table->string('numero_placa')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('linea')->nullable(true);
            $table->string('alias')->nullable(true);
            $table->boolean('estado')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
};
