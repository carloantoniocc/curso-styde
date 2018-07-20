<?php

use Illuminate\Database\Seeder;
use App\Profession;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //nivel 1 realizando consulta con DB sql devuelve un objeto collection
        //$professions = DB:select('select id from proffesions where title = ?', ['Desarrollador back-end']);

        // usando DB con eloquent devuelve un objeto
        //$profession = DB::table('professions')->select('id')->first();

        //devuelve un id directamente del obejto Profession
        $professionId = Profession::whereTitle('Desarrollador back-end')->value('id');        

        factory(User::class)->create([
        	'name' => 'Carlos Cornejo',
        	'email' => 'carlos.cornejo@redsalud.gov.cl',
        	'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true,
        ]);

        factory(User::class)->create([ 'profession_id' => $professionId ]);

        factory(User::class, 50)->create();

    }
}
