<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profession extends Model
{
   
   //para detectar el nombre de una tabla que mantenga el formato de creacion laravel no es necesario
   //protected $table = "profesions";

	//con esto mantengo proteccion contra asignacion masiva
	protected $table = 'professions';


	protected $fillable = ['title'];


	public function users()
	{
		return $this->hasMany(User::class);
	}

}
