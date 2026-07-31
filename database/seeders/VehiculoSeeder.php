<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehiculos')->insert(['codigo'=>'0001','tipo_vehiculo'=>'3','tipo_placa'=>'1','numero_placa'=>'123phf','marca'=>'2','modelo'=>'1','linea'=>'FR','alias'=>'el robot','estado'=>1]);
        DB::table('vehiculos')->insert(['codigo'=>'0002','tipo_vehiculo'=>'1','tipo_placa'=>'2','numero_placa'=>'455hfj','marca'=>'2','modelo'=>'1','linea'=>'FR','alias'=>'el rojo','estado'=>1]);

    }
}
