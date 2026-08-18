<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        */
        //anterior

        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->rememberToken();
           // $table->string('codigo_credito');
            $table->integer('codigo')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('cui')->unique();
            $table->string('telefono_principal');
            $table->string('telefono_secundario')->nullable();
            $table->string('tipo_sangre')->nullable();
            $table->string('no_licencia')->nullable();
            $table->date('inicio_labores')->nullable();
            $table->date('fin_labores')->nullable();
            $table->string('direccion_fisica',200)->nullable();


            $table->unsignedBigInteger('direccion_departamento')->nullable(true);
            $table->foreign('direccion_departamento')->references('id')->on('departamentos');



            $table->unsignedBigInteger('direccion_municipio')->nullable(true);
            $table->foreign('direccion_municipio')->references('id')->on('municipios');

            $table->unsignedBigInteger('sucursal_id')->nullable(false);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');



            $table->boolean('estado');
            $table->timestamps();
        });

        //nuevo

          Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // anterior Schema::dropIfExists('users');

        //nuevo
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
