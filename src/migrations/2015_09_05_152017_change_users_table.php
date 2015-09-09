<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sid', 15)->after('id');
            $table->string('surname', 32)->after('name');
            $table->string('patronymic', 32)->after('surname');
            $table->date('birthday');
            $table->string('url_avatar', 100);
            $table->integer('program');
            $table->integer('country');
            $table->string('refer', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
