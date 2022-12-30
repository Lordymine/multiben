<?php

use Illuminate\Database\Seeder;
use App\AdminGrupos;

class AdminGruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminGrupos::create(
            ['nome' => 'administrador','descricao' => 'grupo de administradores do multben']
        );
    }
}
