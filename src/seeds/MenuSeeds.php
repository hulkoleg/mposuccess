<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {

    public function run()
    {
        $item = [
            'name' => '�������',
            'route' => 'home',
            'icon' => 'icon-home',
            'parent' => null,
            'enable' => 1,
        ];

        Menu::create($item);

    }

}