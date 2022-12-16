<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create(
            ['nome' => 'NUTRIÇÃO','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '01.png']
        );

        Categories::create(
            ['nome' => 'PODOLÓGA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '02.png']
        );

        Categories::create(
            ['nome' => 'LAVA JATO','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '03.png']
        );

        Categories::create(
            ['nome' => 'DESIGNER DE SOMBRANCELHA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '04.png']
        );

        Categories::create(
            ['nome' => 'PET SHOP','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '05.png']
        );

        Categories::create(
            ['nome' => 'SALÃO DE BELEZA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '06.png']
        );

        Categories::create(
            ['nome' => 'BARBEARIA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '07.png']
        );

        Categories::create(
            ['nome' => 'GUINCHO','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '08.png']
        );

        Categories::create(
            ['nome' => 'PEÇAS E SERVIÇOS','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '09.png']
        );

        Categories::create(
            ['nome' => 'ACADEMIA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '10.png']
        );

        Categories::create(
            ['nome' => 'DENTISTA','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '11.png']
        );

        Categories::create(
            ['nome' => 'ESTÉTICA facial e corporal','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '12.png']
        );

        Categories::create(
            ['nome' => 'DEPILAÇÃO','descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.','image' => '13.png']
        );
    }
}
