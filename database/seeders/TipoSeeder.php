<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert(['id'=>'1','nombre'=>'Sin Marca','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'2','nombre'=>'Canal','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'3','nombre'=>'Clavo','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'4','nombre'=>'Costanera','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'5','nombre'=>'Flete','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'6','nombre'=>'Gancho','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'7','nombre'=>'Guantes','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'8','nombre'=>'Lamiluz','descripcion'=>'', 'estado'=>1]);

        DB::table('tipos')->insert(['id'=>'9','nombre'=>'Lamina','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'10','nombre'=>'Tornillo','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'11','nombre'=>'Tubo','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'12','nombre'=>'Capote','descripcion'=>'', 'estado'=>1]);
        DB::table('tipos')->insert(['id'=>'13','nombre'=>'Copa','descripcion'=>'', 'estado'=>1]);
    }
}
