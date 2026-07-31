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
        Schema::create('estado_envios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('envio_id');
            $table->foreign('envio_id')->references('id')->on('envios');
            $table->string('proceso_id')->nullable(true);
            $table->string('proceso_nombre')->nullable(true);
            $table->string('estado_id')->nullable(true);
            $table->string('estado_nombre')->nullable(true);
            $table->string('estado_observacion')->nullable(true);
            $table->string('user_id_created_at')->nullable(true);
            $table->string('user_name_created_at')->nullable(true);
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
        Schema::dropIfExists('estado_envios');
    }
};
