<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert(['nombre'=>'N/A','descripcion'=>'No aplica', 'estado'=>1]);
        DB::table('marcas')->insert(['nombre'=>'Alutech','descripcion'=>'', 'estado'=>1]);
        DB::table('marcas')->insert(['nombre'=>'Metaluna','descripcion'=>'', 'estado'=>1]);
        DB::table('marcas')->insert(['nombre'=>'Metalco','descripcion'=>'', 'estado'=>1]);
        DB::table('marcas')->insert(['nombre'=>'Fibrasol','descripcion'=>'', 'estado'=>1]);

    }
}
