<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidads')->insert(['nombre'=>'pediatria','descripcion'=>'area especial para niños','estado'=>1]);
        DB::table('unidads')->insert(['nombre'=>'maternidad','descripcion'=>'area especial para madres','estado'=>1]);
        DB::table('unidads')->insert(['nombre'=>'cardiologia','descripcion'=>'area especial para el corazon','estado'=>1]);
        DB::table('unidads')->insert(['nombre'=>'trauma','descripcion'=>'area especial para los huesos','estado'=>1]);
    }
}
