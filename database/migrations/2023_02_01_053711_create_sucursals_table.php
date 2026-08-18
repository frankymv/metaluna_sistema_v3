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
            $table->integer('codigo')->unique();
            $table->string('nombre',150);
            $table->string('direccion_fisica',200);
            $table->unsignedBigInteger('departamento_id')->nullable(true);
            $table->foreign('departamento_id')->references('id')->on('departamentos');



            $table->unsignedBigInteger('municipio_id')->nullable(true);
            $table->foreign('municipio_id')->references('id')->on('municipios');

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
