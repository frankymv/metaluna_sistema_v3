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
        DB::unprepared('DROP TRIGGER IF EXISTS `add_compra_inventario`');
        DB::unprepared('CREATE TRIGGER add_compra_inventario AFTER INSERT ON compra_producto
        FOR EACH ROW
        BEGIN
            DECLARE exist INT;
            DECLARE sucur_id INT;
            DECLARE invent_id INT DEFAULT 0;
            DECLARE invent_cantidad INT DEFAULT 0;
            DECLARE invent_cantidad_general INT DEFAULT 0;

            SET invent_cantidad_general = (SELECT existencia FROM productos WHERE id=NEW.producto_id);
            SET sucur_id = (SELECT sucursal_id FROM compras WHERE id=NEW.compra_id);

            IF (SELECT EXISTS (SELECT * FROM producto_sucursal WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id)) THEN
                SET invent_cantidad = (SELECT cantidad from producto_sucursal where producto_id = NEW.producto_id and sucursal_id = sucur_id);
                UPDATE producto_sucursal SET cantidad = (invent_cantidad+NEW.cantidad) WHERE producto_id = NEW.producto_id AND sucursal_id = sucur_id;
                UPDATE productos SET existencia = (invent_cantidad_general+NEW.cantidad) WHERE id = NEW.producto_id;
            ELSE
                INSERT INTO producto_sucursal (producto_id, sucursal_id, cantidad) VALUES (NEW.producto_id, sucur_id,NEW.cantidad);
                UPDATE productos SET existencia = (invent_cantidad_general+NEW.cantidad) WHERE id = NEW.producto_id;
            END IF;
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
