<?php

use App\BonusTipo;
use Illuminate\Database\Seeder;

class BonusTipoTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BonusTipo::create(['descricao' => 'Bonus 1', 'nome' => 25.00]);
        BonusTipo::create(['descricao' => 'Bonus 2', 'nome' => 55.00]);
        BonusTipo::create(['descricao' => 'Bonus 3', 'nome' => 70.00]);
    }

}
