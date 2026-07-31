<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //DB::table('ventas')->insert(['cliente_id'=>1,'no_venta'=>0,'fecha_venta'=>Carbon::now()->format('Y-m-d H:i:s'),'total_venta'=>0,'forma_pago'=>'INI','envio'=>0]);
    }
}
