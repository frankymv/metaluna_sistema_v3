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




            Schema::create('envio_venta', function (Blueprint $table) {


                $table->unsignedBigInteger('envio_id');
                $table->foreign('envio_id')->references('id')->on('envios');
                $table->unsignedBigInteger('venta_id');
                $table->foreign('venta_id')->references('id')->on('ventas');

                $table->boolean('entregado')->nullable();
                $table->string('observaciones')->nullable();

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
        Schema::dropIfExists('envio_venta');
    }
};
