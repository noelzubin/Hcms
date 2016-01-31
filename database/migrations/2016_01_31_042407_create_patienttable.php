<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatienttable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('centraldb')->create('patients', function (Blueprint $table) {
            $table->bigInteger('uid')->unique();
            $table->string('password',60);
            $table->integer('hospital');
            $table->string('name');
            $table->string('gender');
            $table->integer('yob');
            $table->string('gname');
            $table->string('house');
            $table->string('street');
            $table->string('lm');
            $table->string('district');
            $table->string('state');
            $table->string('pc');
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
        Schema::connection('centraldb')->drop('patients');
    }
}
