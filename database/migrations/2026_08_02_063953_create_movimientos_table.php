<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('no_movimiento')->null(true)->default(0);
            $table->date('fecha_movimiento');
            $table->enum('tipo_movimiento', ['no_aplica','credito', 'abono', 'abono_anticipado','abono_anticipado_asignado', 'nota_credito'])
                  ->default('no_aplica');
            $table->string('tipo_pago')->nullable(false)->comment('forma de pago el abono');
            $table->string('observaciones')->nullable(true);
            $table->decimal('total_movimiento',10,2)->nullable();
            $table->unsignedBigInteger('venta_id')->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
