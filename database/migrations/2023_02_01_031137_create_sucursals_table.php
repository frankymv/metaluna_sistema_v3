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
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo')->unique();
            $table->string('nombre',150);
            $table->string('direccion_fisica',200);
            $table->integer('direccion_departamento');
            $table->integer('direccion_municipio');
            $table->string('telefono_principal',12)->nullable();
            $table->string('telefono_secundario',12)->nullable();
            $table->string('correo_electronico',200)->nullable();
            $table->boolean('visible')->default('1')->nullable();
            $table->boolean('bodega')->default('0')->nullable();
            $table->boolean('estado')->default('1')->nullable();

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
        Schema::dropIfExists('sucursals');
    }
};
