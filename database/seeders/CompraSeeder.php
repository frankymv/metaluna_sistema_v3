<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compras')->insert(['id'=>'1','compra_no'=>'1','no_recibo_compra'=>'46554','compra_fecha'=>'2024/06/30','proveedor_id'=>'1','sucursal_id'=>'2']);

        DB::table('compra_producto')->insert(['id'=>'1','producto_id'=>'1',	'compra_id'=>'1','cantidad'=>'30']);
        DB::table('compra_producto')->insert(['id'=>'2','producto_id'=>'2',	'compra_id'=>'1','cantidad'=>'700']);

        DB::table('producto_sucursal')->insert(['producto_id'=>'1',	'sucursal_id'=>'2','cantidad'=>'30']);
        DB::table('producto_sucursal')->insert(['producto_id'=>'2',	'sucursal_id'=>'2','cantidad'=>'700']);


    }
}
