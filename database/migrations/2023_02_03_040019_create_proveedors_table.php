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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre',150);
            $table->string('descripcion',300)->nullable();
            $table->string('nit',9)->nullable();
            $table->string('nombre_representante',150)->nullable();
            $table->string('telefono_principal',12);
            $table->string('telefono_secundario',12)->nullable();
            $table->string('direccion_fisica',200);
            $table->string('correo_electronico',200)->nullable();
            $table->boolean('estado');
            $table->timestamps();


            $table->unsignedBigInteger('direccion_departamento')->nullable();
            $table->foreign('direccion_departamento')->references('id')->on('departamentos');



            $table->unsignedBigInteger('direccion_municipio')->nullable();
            $table->foreign('direccion_municipio')->references('id')->on('municipios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
};
