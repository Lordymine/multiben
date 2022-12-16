<?php

use Illuminate\Database\Seeder;
use App\CategoriaEmpresa;

class CategoriaEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaEmpresa::create(['categoria' => 'PARCEIRA']);
        CategoriaEmpresa::create(['categoria' => 'CONVÊNIADA']);
    }
}
