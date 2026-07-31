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
/*
        DB::unprepared('DROP TRIGGER IF EXISTS `add_cliente_creditos_credito`');
        DB::unprepared('CREATE TRIGGER add_cliente_creditos AFTER INSERT ON estado_cuentas
            FOR EACH ROW
            BEGIN
                DECLARE cliente INT;
                DECLARE saldo INT;
                DECLARE saldo_venta_anterior INT;

                IF (NEW.tipo_estado_cuenta = "credito") THEN
                    SET cliente = (SELECT cliente_id FROM ventas WHERE id=NEW.venta_id);
                    UPDATE clientes SET credito_actual = (credito_actual+NEW.cantidad) WHERE id=cliente;
                END IF;

                IF (NEW.tipo_estado_cuenta = "abono") THEN
                    SET cliente = (SELECT cliente_id FROM ventas WHERE id=NEW.venta_id);
                    UPDATE clientes SET credito_actual = (credito_actual-NEW.cantidad) WHERE id=cliente;
                    SET saldo_venta_anterior = (SELECT saldo_venta FROM ventas WHERE id=NEW.venta_id);
                    SET saldo=saldo_venta_anterior-NEW.cantidad;
                        IF (saldo = 0) THEN
                            UPDATE ventas SET saldo_venta = saldo, cancelado=1 WHERE id=NEW.venta_id;
                        ELSE
                            UPDATE ventas SET saldo_venta = saldo, abono_venta=(abono_venta+NEW.cantidad) WHERE id=NEW.venta_id;
                        END IF;
                END IF;
            END
        ');
        */
/*
        DB::unprepared('DROP TRIGGER IF EXISTS `delete_cliente_creditos`');
        DB::unprepared('CREATE TRIGGER delete_cliente_creditos AFTER DELETE ON estado_cuenta
        FOR EACH ROW
        BEGIN
            DECLARE exist INT;
                SET exist = (SELECT existencia FROM productos WHERE id=OLD.producto_id);
                UPDATE productos SET existencia = existencia+OLD.cantidad WHERE id=OLD.producto_id;
            END

        ');*/



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
