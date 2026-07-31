<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedors')->insert(['nombre'=>'Sistema Informatico','nombre_representante'=>'Marcos Amézquita','nit'=>'52125432','telefono_principal'=>'55568978','telefono_secundario'=>'74895623','direccion_fisica'=>'Calle final del calvario, Zona 3, Totonicapan ','direccion_departamento'=>1,'direccion_municipio'=>2,'correo_electronico'=>'admingyg@gmail.com','estado'=>1]);
        DB::table('proveedors')->insert(['nombre'=>'Distribuidos G&G','nombre_representante'=>'Jorge Morales','descripcion'=>'Material de laminas','nit'=>'95496728','telefono_principal'=>'58568978','telefono_secundario'=>'74895623','direccion_fisica'=>'2da. avenida 3-15 zona 2 Guatemala ','direccion_departamento'=>1,'direccion_municipio'=>2,'correo_electronico'=>'admingyg@gmail.com','estado'=>1]);
        DB::table('proveedors')->insert(['nombre'=>'Corporación M&M','nombre_representante'=>'Mateo Pérez','nit'=>'55496728','telefono_principal'=>'32568978','telefono_secundario'=>'74895623','direccion_fisica'=>'4 calle 3-15 Zona 3, Totonicapan ','direccion_departamento'=>1,'direccion_municipio'=>2,'correo_electronico'=>'admingyg@gmail.com','estado'=>1]);
        DB::table('proveedors')->insert(['nombre'=>'Metales S.A.','nombre_representante'=>'Marcos Amézquita','nit'=>'52125432','telefono_principal'=>'55568978','telefono_secundario'=>'74895623','direccion_fisica'=>'Calle final del calvario, Zona 3, Totonicapan ','direccion_departamento'=>1,'direccion_municipio'=>2,'correo_electronico'=>'admingyg@gmail.com','estado'=>1]);
        DB::table('proveedors')->insert(['nombre'=>'Sistema Informatico Inicial','nombre_representante'=>'Luis Amézquita','nit'=>'52125432','telefono_principal'=>'55568978','telefono_secundario'=>'74895623','direccion_fisica'=>'Calle final del calvario, Zona 3, Totonicapan ','direccion_departamento'=>1,'direccion_municipio'=>2,'correo_electronico'=>'admingyg@gmail.com','estado'=>1]);
    }
}
