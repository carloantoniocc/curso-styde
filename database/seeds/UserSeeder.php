<?php

use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$professions = DB:select('select id from proffesions where title = ?', ['Desarrollador back-end']);

        $profession = DB::table('professions')->select('id')->first();


        DB::table('users')->insert([
        	'name' => 'Carlos Cornejo',
        	'email' => 'carlos.cornejo@redsalud.gov.cl',
        	'password' => bcrypt('laravel'),
            'profession_id' => $profession->id,
        ]);
    }
}
