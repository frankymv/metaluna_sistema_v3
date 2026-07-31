<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DepartamentoSeeder ::class);
        $this->call(MunicipioSeeder ::class);
        $this->call(MarcaSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(DisenioSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(VehiculoSeeder::class);
        $this->call(VentaSeeder::class);
        $this->call(CompraSeeder::class);
    }
}
