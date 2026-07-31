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
        Schema::create('productos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo',150)->unique();
            $table->string('nombre',150);
            $table->string('nombre_venta',150)->nullable(true);
            $table->string('descripcion',300)->nullable(true);
            $table->string('calibre')->nullable(true);

            $table->string('longitud')->nullable(true);
            $table->string('tipo_longitud')->nullable(true);
            $table->string('diametro')->nullable(true);
            $table->string('tipo_diametro')->nullable(true);
            $table->string('peso')->nullable(true);
            $table->string('tipo_peso')->nullable(true);

            $table->boolean('divisible')->nullable(true);
            //moneda frk
            $table->decimal('precio_unitario', 10, 2)->default(0)->nullable(true);
            $table->decimal('precio_final', 10, 2)->default(0)->nullable(true);
            $table->integer('existencia')->default(0)->nullable(true);

            $table->boolean('estado')->default(true);

            //$table->unsignedBigInteger('marca_id')->nullable();
            //$table->foreignId('marca_id')->references('id')->on('marcas');
            $table->foreignId('marca_id')->nullable()->constrained()->onDelete('restrict');
            //$table->unsignedBigInteger('tipo_id')->nullable();
            $table->foreignId('tipo_id')->nullable()->constrained()->onDelete('restrict');
            //$table->unsignedBigInteger('material_id')->nullable();
            $table->foreignId('material_id')->nullable()->constrained()->onDelete('restrict');
            //$table->unsignedBigInteger('disenio_id')->nullable();
            $table->foreignId('disenio_id')->nullable()->constrained()->onDelete('restrict');

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
        Schema::dropIfExists('productos');
    }
};
