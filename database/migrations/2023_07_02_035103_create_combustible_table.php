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
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('no_combustible');
            $table->unsignedBigInteger('vehiculo_id')->nullable(true);
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('fecha_combustible');
            $table->float('total_combustible')->default(0)->nullable(true);
            $table->string('observaciones')->nullable(true);
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
        Schema::dropIfExists('combustibles');
    }
};
