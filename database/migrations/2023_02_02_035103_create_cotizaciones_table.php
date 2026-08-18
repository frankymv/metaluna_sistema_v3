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
        Schema::create('cotizacions', function (Blueprint $table) {
           $table->id()->autoIncrement();


            ////////////datos de la venta
            $table->integer('no_venta');
            $table->date('fecha_venta');
            $table->float('total_venta')->comment('registra el total de la venta inicial');
            $table->string('observaciones_venta')->nullable(true)->comment('observaciones sobre la venta');
            $table->string('forma_pago_venta')->comment('forma como fue cancelado el monto total de la venta efec/cheque/transf/deposito/etc');

            /////cancelado el total de la venta///////////
            $table->boolean('cancelado_total_venta')->default(false)->nullable(true)->comment('se ha cancelado el monto total de la venta');
            $table->date('fecha_cancelado_total_venta')->nullable(true);

            /////credito///////////
            $table->boolean('credi')->default(0)->nullable(true)->comment('fue aplicado un credito a la venta');
            $table->float('total_credito')->default(0)->nullable(true)->comment('total del credito al crear la venta');

            /////anulado///////////
            $table->boolean('anulado')->default(false)->nullable(true)->comment('fue anula la venta');
            $table->date('fecha_anulado')->nullable(true);
            /////notacredito///////////
            $table->boolean('nota_credito')->default(0)->nullable(true)->comment('fue aplicado una nota de credito');
            $table->float('total_nota_credito')->default(0)->nullable(true);
            /////notacredito///////////
            $table->boolean('abono')->default(0)->nullable(true)->comment('fue aplicado un abono');
            $table->float('total_abono')->default(0)->nullable(true);

            /////si requiere envio o traslado a la ubicacion del cliente
            $table->string('envio')->nullable(true)->default('SINENVIO')->comment('si requiere envio o traslado a la ubicacion del cliente enlazado a ruta/envio');
            $table->string('estado_envio')->nullable(true)->default('NO/APLICA')->comment('finalizo el proceso de envio ruta/envio');

            //registro de operaciones a una venta
            $table->integer('correlativo')->nullable(true)->default('0')->comment('correlativo para el seguimiento de las operaciones de abono y notas de credito');
            ////visible ante los registros y operaciones
            $table->boolean('visible')->default(true)->nullable(true);

            //////CLIENTE////////
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

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
        Schema::dropIfExists('cotizacions');
    }
};
