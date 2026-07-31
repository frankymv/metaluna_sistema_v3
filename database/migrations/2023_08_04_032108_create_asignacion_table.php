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
        Schema::create('asignacions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('no_orden');
            $table->date('fecha');
            $table->boolean('estado')->nullable(true);

            $table->unsignedBigInteger('ruta_id')->nullable(true);
            $table->foreign('ruta_id')->references('id')->on('rutas');

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
        Schema::dropIfExists('asignacions');
    }
};
