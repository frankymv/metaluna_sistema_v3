<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disenios')->insert(['id'=>'1','nombre'=>'N/A','descripcion'=>'No aplica', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'2','nombre'=>'Acanalada','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'3','nombre'=>'Cuadrado','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'4','nombre'=>'Cuadrados con tope','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'5','nombre'=>'Cuadrados con tope y bajada','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'6','nombre'=>'Cuadrados lisos','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'7','nombre'=>'Lisa','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'8','nombre'=>'Normal','descripcion'=>'', 'estado'=>1]);

        DB::table('disenios')->insert(['id'=>'9','nombre'=>'Omega','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'10','nombre'=>'Para canal cuadrado','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'11','nombre'=>'Pachon','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'12','nombre'=>'Para lamina','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'13','nombre'=>'Para madera','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'14','nombre'=>'Punta de broca','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'15','nombre'=>'Punta de broca con color','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'16','nombre'=>'Punta normal','descripcion'=>'', 'estado'=>1]);

        DB::table('disenios')->insert(['id'=>'17','nombre'=>'Rectangular','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'18','nombre'=>'Redondo','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'19','nombre'=>'Redondos con rosa y copla','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'20','nombre'=>'Redondos con tope','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'21','nombre'=>'Redondos con tope y bajada','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'22','nombre'=>'Tipo teja','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'23','nombre'=>'Troquelada','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'24','nombre'=>'Troquelada angosta','descripcion'=>'', 'estado'=>1]);

        DB::table('disenios')->insert(['id'=>'25','nombre'=>'Troquelados lisos','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'26','nombre'=>'Redondos lisos','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'27','nombre'=>'Troquelados con dientes','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'28','nombre'=>'Cheque Rechazado','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'29','nombre'=>'Para tornillo','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'30','nombre'=>'P/Canal redondo','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'31','nombre'=>'P/Canal Cuadrado','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'32','nombre'=>'Producto Auxiliar','descripcion'=>'', 'estado'=>1]);

        DB::table('disenios')->insert(['id'=>'33','nombre'=>'Promocional pachon','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'34','nombre'=>'Polser punta de broca','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'35','nombre'=>'Polser punta normal','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'36','nombre'=>'Polser punta de broca con color','descripcion'=>'', 'estado'=>1]);
        DB::table('disenios')->insert(['id'=>'37','nombre'=>'Redondo con rosca y copla','descripcion'=>'', 'estado'=>1]);

    }
}
