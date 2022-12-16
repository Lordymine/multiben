<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(AdminGruposTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(CategoriaEmpresaSeeder::class);
        $this->call(EstadosTableSeeder::class);
    }
}
