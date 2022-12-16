<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcelo = User::create([
            'name' => 'Marcelo',
            'sobrenome' => 'Maia',
            'email' => 'mamaiapinheiro@gmail.com',
            'telefone' => 91981304155,
            'password' => Hash::make(123456),
            'matricula' => 91981304155,
            'responsavel_empresa' => 'Teste Marcelo'
        ]);

        $felipe = User::create([
            'name' => 'Felipe',
            'sobrenome' => 'Pastana',
            'email' => 'felipe@fhwebsystems.com',
            'telefone' => 16475729674,
            'password' => Hash::make(123456),
            'matricula' => 16476729674,
            'responsavel_empresa' => 'Teste Felipe'
        ]);

        $bruno = User::create([
            'name' => 'Bruno',
            'sobrenome' => 'Iglesias',
            'email' => 'bruno.iglesias.eng@gmail.com',
            'telefone' => 92991486536,
            'password' => Hash::make(123456),
            'matricula' => 92991486536,
            'responsavel_empresa' => 'Teste Bruno'
        ]);
    }
}
