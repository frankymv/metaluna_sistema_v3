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
        DB::table('sucursals')->insert(['id'=>1,'codigo'=>'0000','nombre'=>'Independiente','direccion_fisica'=>'Zona 3','direccion_departamento'=>'1','direccion_municipio'=>'1','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>2,'codigo'=>'0001','nombre'=>'Bodega 1','direccion_fisica'=>'Zona 3','direccion_departamento'=>'1','direccion_municipio'=>'1','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>3,'codigo'=>'0002','nombre'=>'Bodega 2','direccion_fisica'=>'Zona 2','direccion_departamento'=>'8','direccion_municipio'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>4,'codigo'=>'0003','nombre'=>'Bodega 4','direccion_fisica'=>'Zona 2','direccion_departamento'=>'8','direccion_municipio'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);
        DB::table('sucursals')->insert(['id'=>5,'codigo'=>'0004','nombre'=>'Tienda Central','direccion_fisica'=>'Zona 2','direccion_departamento'=>'8','direccion_municipio'=>'2','estado'=>1,'bodega'=>1,'visible'=>1]);

    }
}
