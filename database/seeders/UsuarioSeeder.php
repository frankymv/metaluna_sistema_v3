<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['codigo'=>'1','nombres'=>'Franky','apellidos'=>'Vicente','fecha_nacimiento'=>'1988-05-19','cui'=>'1733333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50240404040','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-01-01','usuario'=>'franky01', 'email'=>'franky@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'2','nombres'=>'Luis','apellidos'=>'Tzoc','fecha_nacimiento'=>'1990-04-21','cui'=>'1833333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50250505050','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'luis01', 'email'=>'luis@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'3','nombres'=>'Edwin','apellidos'=>'Tzic','fecha_nacimiento'=>'1995-02-01','cui'=>'1933333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'edwin01', 'email'=>'edwin@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'4','nombres'=>'Pedro','apellidos'=>'Blanco','fecha_nacimiento'=>'1995-02-01','cui'=>'2033333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'pedro01', 'email'=>'pedro@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>3,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'5','nombres'=>'Mario','apellidos'=>'Tzul','fecha_nacimiento'=>'1995-02-01','cui'=>'2133333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'mario01', 'email'=>'mario@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>1,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'6','nombres'=>'Juan','apellidos'=>'Mejía','fecha_nacimiento'=>'1988-05-19','cui'=>'2233333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50240404040','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-01-01','usuario'=>'juan01', 'email'=>'juan@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'7','nombres'=>'Roberto','apellidos'=>'Gomez','fecha_nacimiento'=>'1990-04-21','cui'=>'2333333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50250505050','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'roberto01', 'email'=>'roberto@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'8','nombres'=>'Antonio','apellidos'=>'Tzic','fecha_nacimiento'=>'1995-02-01','cui'=>'2433333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'antonio01', 'email'=>'antonio@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'9','nombres'=>'Fernando','apellidos'=>'De Leon','fecha_nacimiento'=>'1995-02-01','cui'=>'2533333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'fernando01', 'email'=>'fernando@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>3,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'10','nombres'=>'Gloria','apellidos'=>'Tzul','fecha_nacimiento'=>'1995-02-01','cui'=>'2633333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1000','inicio_labores'=>'2020-05-01','usuario'=>'gloria01', 'email'=>'gloria@gmail.com','password'=>bcrypt('1234'),'sucursal_id'=>1,'estado'=>true]);

        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'1']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'2']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'3']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'4']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'5']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'6']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'7']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'8']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'9']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'10']);
    }
}