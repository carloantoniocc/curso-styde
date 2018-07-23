<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    //

    public function index()
    {

        $users = User::all();
    	$title = 'Listado de Usuarios';

    	return view('users.index', compact('users','title'));

    }

    public function show(User $user)
    {

        return view('users.show',compact('user'));
    }

    public function create()
    {
    	return view('users.create');
    }

    public function store()
    {

        $data = request()->validate([
            'name' => 'required',
        ]);



        User::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('usuarios');
    }

    
    public function edit($id)
    {
    	return "usuario {$id} ha sido modificado";
    }

}
