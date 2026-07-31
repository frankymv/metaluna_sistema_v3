<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert(['id'=>'1','nombre'=>'Guatemala','codigo'=>'01']);
        DB::table('departamentos')->insert(['id'=>'2','nombre'=>'El Progreso','codigo'=>'02']);
        DB::table('departamentos')->insert(['id'=>'3','nombre'=>'Sacatepéquez','codigo'=>'03']);
        DB::table('departamentos')->insert(['id'=>'4','nombre'=>'Chimaltenango','codigo'=>'04']);
        DB::table('departamentos')->insert(['id'=>'5','nombre'=>'Escuintla','codigo'=>'05']);
        DB::table('departamentos')->insert(['id'=>'6','nombre'=>'Santa Rosa','codigo'=>'06']);
        DB::table('departamentos')->insert(['id'=>'7','nombre'=>'Sololá','codigo'=>'07']);
        DB::table('departamentos')->insert(['id'=>'8','nombre'=>'Totonicapán','codigo'=>'08']);
        DB::table('departamentos')->insert(['id'=>'9','nombre'=>'Quetzaltenango','codigo'=>'09']);
        DB::table('departamentos')->insert(['id'=>'10','nombre'=>'Suchitepéquez','codigo'=>'10']);
        DB::table('departamentos')->insert(['id'=>'11','nombre'=>'Retalhuleu','codigo'=>'11']);
        DB::table('departamentos')->insert(['id'=>'12','nombre'=>'San Marcos','codigo'=>'12']);
        DB::table('departamentos')->insert(['id'=>'13','nombre'=>'Huehuetenango','codigo'=>'13']);
        DB::table('departamentos')->insert(['id'=>'14','nombre'=>'Quiché','codigo'=>'14']);
        DB::table('departamentos')->insert(['id'=>'15','nombre'=>'Baja Verapaz','codigo'=>'15']);
        DB::table('departamentos')->insert(['id'=>'16','nombre'=>'Alta Verapaz','codigo'=>'16']);
        DB::table('departamentos')->insert(['id'=>'17','nombre'=>'Petén','codigo'=>'17']);
        DB::table('departamentos')->insert(['id'=>'18','nombre'=>'Izabal','codigo'=>'18']);
        DB::table('departamentos')->insert(['id'=>'19','nombre'=>'Zacapa','codigo'=>'19']);
        DB::table('departamentos')->insert(['id'=>'20','nombre'=>'Chiquimula','codigo'=>'20']);
        DB::table('departamentos')->insert(['id'=>'21','nombre'=>'Jalapa','codigo'=>'21']);
        DB::table('departamentos')->insert(['id'=>'22','nombre'=>'Jutiapa','codigo'=>'22']);
        
        
    }
}
