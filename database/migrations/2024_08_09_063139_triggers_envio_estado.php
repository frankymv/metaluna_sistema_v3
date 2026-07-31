<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        DB::unprepared('DROP TRIGGER IF EXISTS `add_envio_estado`');
        DB::unprepared('CREATE TRIGGER add_envio_estado AFTER INSERT ON estado_envios
            FOR EACH ROW
            BEGIN
                    UPDATE envios SET proceso_id=NEW.proceso_id, proceso_nombre=NEW.proceso_nombre,estado_id = NEW.estado_id, estado_nombre=NEW.estado_nombre, estado_observacion=NEW.estado_observacion, estado_fecha=NEW.created_at WHERE id=NEW.envio_id;

            END
        ');





/*
        DB::unprepared('DROP TRIGGER IF EXISTS `add_cliente_creditos`');
        DB::unprepared('CREATE TRIGGER add_cliente_creditos AFTER INSERT ON estado_cuentas
            FOR EACH ROW
            BEGIN

            DECLARE idCliente INT;




            IF (NEW.tipo_estado_cuenta="credito") THEN
                    SET idCliente = (SELECT cliente_id FROM ventas WHERE id=NEW.venta_id);
                    UPDATE clientes SET credito_actual = credito_actual+NEW.cantidad WHERE id=idCliente;
                ELSE IF (NEW.tipo_estado_cuenta="abono") THEN
                    SET idCliente = (SELECT cliente_id FROM ventas WHERE id=NEW.venta_id);
                    UPDATE productos SET existencia = (exist-NEW.cantidad) WHERE id=NEW.producto_id;
                END IF;



            DECLARE exist INT;





                SET exist = (SELECT existencia FROM productos WHERE id=NEW.producto_id);
                UPDATE productos SET existencia = (exist-NEW.cantidad) WHERE id=NEW.producto_id;
            END
        ');

        DB::unprepared('DROP TRIGGER IF EXISTS `delete_producto_venta`');
        DB::unprepared('CREATE TRIGGER delete_producto_venta AFTER DELETE ON estado_cuentas
        FOR EACH ROW
        BEGIN
            DECLARE exist INT;
                SET exist = (SELECT existencia FROM productos WHERE id=OLD.producto_id);
                UPDATE productos SET existencia = existencia+OLD.cantidad WHERE id=OLD.producto_id;
            END

        ');
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
