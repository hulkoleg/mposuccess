<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Notprometey\Mposuccess\Models\User;

class UserSeeder extends Seeder {

    public function run()
    {
        $year = date('Y');
        $codeCountry = str_pad(7, 4, "0", STR_PAD_LEFT);

        /*
         * Create user COMPANY
         */
        User::create([
            'sid'       => $codeCountry . $year . 100001,
            'name'      => 'company',
            'email'     => 'company@mposuccess.ru',
            'password'  => 'company',
        ]);

        /*
         * Create user and role ADMIN
         */
        $user = User::create([
            'sid'       => $codeCountry . $year . 100002,
            'name'      => 'admin',
            'email'     => 'admin@mposuccess.ru',
            'password'  => 'admin',
        ]);

        $adminRole = Role::create([
            'name'      => 'Admin',
            'slug'      => 'admin',
        ]);

        $user->attachRole($adminRole);

        /*
         * Create user and role MODERATOR
         */
        $user = User::create([
            'sid'       => $codeCountry . $year . 100003,
            'name'      => 'moderator',
            'email'     => 'moderator@mposuccess.ru',
            'password'  => 'moderator',
        ]);

        $moderatorRole = Role::create([
            'name'      => 'Moderator',
            'slug'      => 'moderator',
        ]);

        $user->attachRole($moderatorRole);

        /*
         * Create user and role USER
         */
        $user = User::create([
            'sid'       => $codeCountry . $year . 100004,
            'name'      => 'user',
            'email'     => 'user@mposuccess.ru',
            'password'  => 'user',
        ]);

        $userRole = Role::create([
            'name'      => 'User',
            'slug'      => 'user',
        ]);

        $user->attachRole($userRole);

        /*
         * Create user and role badUser - not verified user
         */
        $user = User::create([
            'sid'       => $codeCountry . $year . 100005,
            'name'      => 'test',
            'email'     => 'test@mposuccess.ru',
            'password'  => 'test',
        ]);

        $badUserRole = Role::create([
            'name'      => 'badUser',
            'slug'      => 'bad.user',
        ]);

        $user->attachRole($badUserRole);
    }
}
