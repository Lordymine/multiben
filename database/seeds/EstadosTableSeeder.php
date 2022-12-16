<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadosTableSeeder  extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['codigo_uf' => 12, 'nome' => 'Acre', 'uf' => 'AC', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 27, 'nome' => 'Alagoas', 'uf' => 'AL', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 16, 'nome' => 'Amapá', 'uf' => 'AP', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 13, 'nome' => 'Amazonas', 'uf' => 'AM', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 29, 'nome' => 'Bahia', 'uf' => 'BA', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 23, 'nome' => 'Ceará', 'uf' => 'CE', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 53, 'nome' => 'Distrito Federal', 'uf' => 'DF', 'regiao' => 5]);
        Estado::create(['codigo_uf' => 32, 'nome' => 'Espírito Santo', 'uf' => 'ES', 'regiao' => 3]);
        Estado::create(['codigo_uf' => 52, 'nome' => 'Goiás', 'uf' => 'GO', 'regiao' => 5]);
        Estado::create(['codigo_uf' => 21, 'nome' => 'Maranhão', 'uf' => 'MA', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 51, 'nome' => 'Mato Grosso', 'uf' => 'MT', 'regiao' => 5]);
        Estado::create(['codigo_uf' => 50, 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS', 'regiao' => 5]);
        Estado::create(['codigo_uf' => 31, 'nome' => 'Minas Gerais', 'uf' => 'MG', 'regiao' => 3]);
        Estado::create(['codigo_uf' => 15, 'nome' => 'Pará', 'uf' => 'PA', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 25, 'nome' => 'Paraíba', 'uf' => 'PB', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 41, 'nome' => 'Paraná', 'uf' => 'PR', 'regiao' => 4]);
        Estado::create(['codigo_uf' => 26, 'nome' => 'Pernambuco', 'uf' => 'PE', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 22, 'nome' => 'Piauí', 'uf' => 'PI', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 33, 'nome' => 'Rio de Janeiro', 'uf' => 'RJ', 'regiao' => 3]);
        Estado::create(['codigo_uf' => 24, 'nome' => 'Rio Grande do Norte', 'uf' => 'RN', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 43, 'nome' => 'Rio Grande do Sul', 'uf' => 'RS', 'regiao' => 4]);
        Estado::create(['codigo_uf' => 11, 'nome' => 'Rondônia', 'uf' => 'RO', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 14, 'nome' => 'Roraima', 'uf' => 'RR', 'regiao' => 1]);
        Estado::create(['codigo_uf' => 42, 'nome' => 'Santa Catarina', 'uf' => 'SC', 'regiao' => 4]);
        Estado::create(['codigo_uf' => 35, 'nome' => 'São Paulo', 'uf' => 'SP', 'regiao' => 3]);
        Estado::create(['codigo_uf' => 28, 'nome' => 'Sergipe', 'uf' => 'SE', 'regiao' => 2]);
        Estado::create(['codigo_uf' => 17, 'nome' => 'Tocantins', 'uf' => 'TO', 'regiao' => 1]);
    }

}
