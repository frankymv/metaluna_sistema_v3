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
        Schema::create('compra_producto', function (Blueprint $table) {
            $table->id()->autoIncrement();

            $table->unsignedBigInteger('producto_id')->nullable(true);
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compras');

            $table->integer('cantidad')->nullable();
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
        Schema::dropIfExists('compra_producto');
    }
};
