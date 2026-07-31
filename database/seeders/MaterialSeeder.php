<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert(['nombre'=>'N/A','descripcion'=>'No aplica', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Aluminio','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Aluminio con color','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Aluminio roja','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Aluminio segunda','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Fibra de vidrio amarilla','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Galvanizado','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Galvanizado segunda','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Hule','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Lechosa','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Metal','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Negra','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Negra segunda','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Policarbonato bronce','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Policarbonato especial','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Policarbonato lechosa','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Policarbonato transparente','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Policarbonato verdosa','descripcion'=>'', 'estado'=>1]);
        DB::table('materials')->insert(['nombre'=>'Plástico','descripcion'=>'', 'estado'=>1]);
    }
}
