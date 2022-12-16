<?php

use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcelo = Empresa::create([
            'razao_social' => 'Empresa do Marcelo',
            'cnpj' => 91981304155,
            'endereco' => 'Rua do Marcelo',
            'cep' => '69000-000',
            'telefone' => 91981304155,
            'user_id'=> 1,
            'responsavel' => 'Teste Marcelo',
            'uf' => 33,
            'cidade' => 3304557
        ]);

        $felipe = Empresa::create([
            'razao_social' => 'Empresa do Felipe',
            'cnpj' => 16475729674,
            'endereco' => 'Rua do Felipe',
            'cep' => '69000-000',
            'telefone' => 16475729674,
            'user_id'=> 2,
            'responsavel' => 'Teste Felipe',
            'uf' => 26,
            'cidade' => 2602308
        ]);

        $bruno = Empresa::create([
            'razao_social' => 'Empresa do Bruno',
            'cnpj' => 991486536,
            'endereco' => 'Rua do Felipe',
            'cep' => '69000-000',
            'telefone' => 991486536,
            'user_id'=> 3,
            'responsavel' => 'Teste Bruno',
            'uf' => 33,
            'cidade' => 3304557
        ]);
    }
}
