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
        Schema::create('producto_traslado', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('traslado_id')->nullable(true);
            $table->foreign('traslado_id')->references('id')->on('traslados');
            $table->unsignedBigInteger('producto_id')->nullable(true);
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('cantidad')->nullable(false)->default(0);
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
        Schema::dropIfExists('producto_traslado');
    }
};
