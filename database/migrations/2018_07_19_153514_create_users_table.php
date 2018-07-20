<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profession_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('is_admin')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('profession_id')->references('id')->on('professions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
