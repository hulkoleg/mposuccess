<?php

use Illuminate\Database\Seeder;
use Notprometey\Mposuccess\Models\Country;
use Notprometey\Mposuccess\Models\Program;

class TablesSeeder extends Seeder {

    public function run()
    {
        /*
         * Create countries
         */
        Country::create([
            'name'  => 'Беларусь',
            'flag'  => 'BY',
            'code'  => '375',
        ]);

        Country::create([
            'name'  => 'Российская федерация',
            'flag'  => 'RU',
            'code'  => '7',
        ]);

        Country::create([
            'name'  => 'Украина',
            'flag'  => 'UA',
            'code'  => '380',
        ]);

        /*
         * Create programs
         */
        Program::create([
            'name'  => 'Покупка продукта',
        ]);

        Program::create([
            'name'  => 'Вступление в МПО',
        ]);
    }
}
