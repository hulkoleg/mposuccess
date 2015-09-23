<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function($table)
        {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('flag', 3);
            $table->string('code', 4);
        });

        Schema::create('programs', function($table)
        {
            $table->increments('id');
            $table->string('name', 100);
        });

        Schema::create('news', function($table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->mediumText('preview');
            $table->longText('content');
            $table->boolean('display');
            $table->integer('type');
            $table->string('img', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('programs');
    }
}
