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


DB::unprepared('DROP TRIGGER IF EXISTS `add_venta_inventario`');
DB::unprepared('CREATE TRIGGER add_venta_inventario AFTER INSERT ON producto_venta
    FOR EACH ROW
    BEGIN

    DECLARE exist INT;
    DECLARE sucur_id INT;
     DECLARE tipo_doc VARCHAR(10);
    DECLARE invent_id INT DEFAULT 0;
    DECLARE invent_cantidad INT DEFAULT 0;


                DECLARE prioridad_contador INT DEFAULT 1;
            DECLARE sucursal_end BOOLEAN DEFAULT FALSE;
            DECLARE sucursal_origen INT DEFAULT 1;
            DECLARE cantidad_temp INT;
            DECLARE total INT;



            SET sucur_id = (SELECT sucursal_id FROM ventas WHERE id=NEW.venta_id);



                SET total=NEW.cantidad;
                SET exist = (SELECT existencia FROM productos WHERE id=NEW.producto_id);
                UPDATE productos SET existencia = (exist-NEW.cantidad) WHERE id=NEW.producto_id;



        IF (SELECT EXISTS (SELECT * FROM producto_sucursal WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id)) THEN

            SET invent_cantidad = (SELECT cantidad from producto_sucursal where producto_id = NEW.producto_id and sucursal_id = sucur_id);
            UPDATE producto_sucursal SET cantidad = (invent_cantidad-NEW.cantidad) WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id;

        ELSE

            INSERT INTO producto_sucursal (producto_id, sucursal_id, cantidad) VALUES (NEW.producto_id, sucur_id,NEW.cantidad);
        END IF;



END
');


        DB::unprepared('DROP TRIGGER IF EXISTS `delete_producto_venta`');
        DB::unprepared('CREATE TRIGGER delete_producto_venta AFTER DELETE ON producto_venta
        FOR EACH ROW
        BEGIN
            DECLARE exist INT;
                SET exist = (SELECT existencia FROM productos WHERE id=OLD.producto_id);
                UPDATE productos SET existencia = existencia+OLD.cantidad WHERE id=OLD.producto_id;
            END
        ');

    /*
        DB::unprepared('DROP TRIGGER IF EXISTS `add_venta_inventario`');
        DB::unprepared('CREATE TRIGGER add_venta_inventario AFTER INSERT ON producto_venta
            FOR EACH ROW
            BEGIN
            DECLARE exist INT;
            DECLARE sucur_id INT;
            DECLARE invent_id INT DEFAULT 0;
            DECLARE invent_cantidad INT DEFAULT 0;

            SET sucur_id = (SELECT sucursal_id FROM venta WHERE id=NEW.venta_id);

            IF (SELECT EXISTS (SELECT * FROM producto_sucursal WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id)) THEN
                SET invent_cantidad = (SELECT cantidad from producto_sucursal where producto_id = NEW.producto_id and sucursal_id = sucur_id);
                UPDATE producto_sucursal SET cantidad = (invent_cantidad+NEW.cantidad) WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id;
            ELSE
                INSERT INTO producto_sucursal (producto_id, sucursal_id, cantidad) VALUES (NEW.producto_id, sucur_id,NEW.cantidad);
            END IF;
        END
        ');

        //funcionanod bastante bien
        DB::unprepared('DROP TRIGGER IF EXISTS `add_traslado_inventario`');
        DB::unprepared('CREATE TRIGGER add_traslado_inventario AFTER INSERT ON compra_producto
        FOR EACH ROW
        BEGIN

        DECLARE exist INT;
        DECLARE sucur_id INT;
        DECLARE invent_id INT DEFAULT 0;
        DECLARE invent_cantidad_origen INT DEFAULT 0;

        SET sucur_id = (SELECT sucursal_id FROM compras WHERE id=NEW.compra_id);
        IF (SELECT EXISTS (SELECT * FROM inventarios WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id)) THEN
            SET invent_id = (SELECT id FROM inventarios WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id);
            SET invent_cantidad_origen = (SELECT cantidad from inventarios where producto_id = NEW.producto_id and sucursal_id = sucur_id);
            UPDATE inventarios SET cantidad = (invent_cantidad_origen+NEW.cantidad) WHERE id=invent_id;
        ELSE
            INSERT INTO inventarios (producto_id, sucursal_id, cantidad) VALUES (NEW.producto_id, sucur_id,NEW.cantidad);
        END IF;
        END
                ');
        DB::unprepared('DROP TRIGGER IF EXISTS `add_traslado_inventario`');
            DB::unprepared('CREATE TRIGGER add_traslado_inventario AFTER INSERT ON compra_producto
                FOR EACH ROW
                BEGIN
                    DECLARE exist INT;
                    DECLARE sucur INT;
                    DECLARE inven INT;
                    SET sucur = (SELECT sucursal_id FROM compras WHERE id=NEW.compra_id);
                    SET exist = (SELECT existencia FROM productos WHERE id=NEW.producto_id);
                    INSERT INTO inventarios (id,producto_id, sucursal_id, cantidad) VALUES (NEW.id,NEW.producto_id, sucur, NEW.cantidad) ON DUPLICATE KEY UPDATE producto_id = NEW.producto_id, sucursal_id = sucur, cantidad = NEW.cantidad;
                END
            ');
            DB::unprepared('DROP TRIGGER IF EXISTS `add_traslado_inventario`');
            DB::unprepared('CREATE TRIGGER add_traslado_inventario AFTER INSERT ON compra_producto
                FOR EACH ROW
                BEGIN
                DECLARE exist INT;
                    SET exist = (SELECT existencia FROM productos WHERE id=NEW.producto_id);
                    UPDATE productos SET existencia = (exist+NEW.cantidad) WHERE id=NEW.producto_id;
                END
            ');
            DB::unprepared('DROP TRIGGER IF EXISTS `delete_traslado_inventario`');
            DB::unprepared('CREATE TRIGGER delete_traslado_inventario AFTER DELETE ON compra_producto
            FOR EACH ROW
            BEGIN
                DECLARE exist INT;
                    SET exist = (SELECT existencia FROM productos WHERE id=OLD.producto_id);
                    UPDATE productos SET existencia = existencia-OLD.cantidad WHERE id=OLD.producto_id;
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
