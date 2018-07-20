<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profession;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
            'is_admin' => 'boolean'
    ];

    public function profession() //profession + _id
    {

        return $this->belongsTo(Profession::class);

    }

    public function is_admin()
    {
        return $this->is_admin;
    }

}
