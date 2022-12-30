<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_marcelo = Admin::create(
            ['user_id' => 1,'grupo_id' => 1]
        );

        $admin_felipe = Admin::create(
            ['user_id' => 2,'grupo_id' => 1]
        );

        $admin_bruno = Admin::create(
            ['user_id' => 3,'grupo_id' => 1]
        );
    }
}
