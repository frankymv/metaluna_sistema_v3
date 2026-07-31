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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id()->autoIncrement();

            ////////////datos de la venta
            $table->integer('no_venta');
            $table->date('fecha_venta');
            $table->decimal('total_venta',10,2)->comment('registra el total de la venta inicial');
            $table->string('observaciones_venta')->nullable(true)->comment('observaciones sobre la venta');
            $table->string('forma_pago_venta')->comment('forma como fue cancelado el monto total de la venta efec/cheque/transf/deposito/etc');

            /////cancelado el total de la venta///////////
            $table->boolean('cancelado_total_venta')->default(false)->nullable(true)->comment('se ha cancelado el monto total de la venta');
            $table->date('fecha_cancelado_total_venta')->nullable(true);

            /////credito///////////
            $table->boolean('credi')->default(0)->nullable(true)->comment('fue aplicado un credito a la venta');
            $table->decimal('total_credito',10,2)->default(0)->nullable(true)->comment('total del credito al crear la venta');
            $table->date('fecha_limite_credito')->nullable(true)->comment('fecha limite para cancelar el credito');
            $table->date('fecha_cancelado_credito')->nullable(true)->comment('fecha que se cancelo el credito');
            $table->string('observaciones_credito')->nullable(true)->comment('observaciones sobre el credito');

            /////anulado///////////
            $table->boolean('anulado')->default(false)->nullable(true)->comment('fue anula la venta');
            $table->date('fecha_anulado')->nullable(true);
            /////notacredito///////////
            $table->boolean('nota_credito')->default(0)->nullable(true)->comment('fue aplicado una nota de credito');
            $table->decimal('total_nota_credito',10,2)->default(0)->nullable(true);
            $table->integer('correlativo_nota_credito')->nullable(true)->default('0')->comment('correlativo para las notas de credito');
            /////notacredito///////////
            $table->boolean('abono')->default(0)->nullable(true)->comment('fue aplicado un abono');
            $table->decimal('total_abono',10,2)->default(0)->nullable(true);
            $table->integer('correlativo_abono')->nullable(true)->default('0')->comment('correlativo para el los abonos');

            /////si requiere envio o traslado a la ubicacion del cliente
            $table->string('envio')->nullable(true)->default('SINENVIO')->comment('si requiere envio o traslado a la ubicacion del cliente enlazado a ruta/envio');
            $table->string('estado_envio')->nullable(true)->default('NO/APLICA')->comment('finalizo el proceso de envio ruta/envio');

            //registro de operaciones a una venta
            ////visible ante los registros y operaciones
            $table->boolean('visible')->default(true)->nullable(true);

            //////CLIENTE////////
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->decimal('anticipo_v',10,2)->comment('registra el anticipo al momento de la venta')->default(0.0);
            $table->decimal('nuevo_saldo_v',10,2)->comment('registra el nuevo saldo de credito al momento de la venta')->default(0.0);
            $table->decimal('saldo_anterior_v',10,2)->comment('registra el nuevo saldo de credito al momento de la venta')->default(0.0);

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
        Schema::dropIfExists('ventas');
    }
};
