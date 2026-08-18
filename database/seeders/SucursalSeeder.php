<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('sucursals')->insert(['id'=>1,'codigo'=>'1','nombre'=>'Independiente','telefono_principal'=>'56567890','direccion_fisica'=>'Zona 3','departamento_id'=>'1','municipio_id'=>'1','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>2,'codigo'=>'2','nombre'=>'Bodega 1','telefono_principal'=>'56567890','direccion_fisica'=>'Zona 3','departamento_id'=>'1','municipio_id'=>'1','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>3,'codigo'=>'3','nombre'=>'Bodega 2','telefono_principal'=>'56567890','direccion_fisica'=>'Zona 2','departamento_id'=>'8','municipio_id'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>4,'codigo'=>'4','nombre'=>'Bodega 4','telefono_principal'=>'56567890','direccion_fisica'=>'Zona 2','departamento_id'=>'8','municipio_id'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>5,'codigo'=>'5','nombre'=>'Tienda Central','telefono_principal'=>'56567890','direccion_fisica'=>'Zona 2','departamento_id'=>'8','municipio_id'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);

    }
}
