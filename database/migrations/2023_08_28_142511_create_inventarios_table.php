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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('producto_id')->nullable(true);
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->integer('cantidad')->nullable(true);
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
        Schema::dropIfExists('inventarios');
    }
};
