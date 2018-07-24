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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ],[

            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
        ]);


        User::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('usuarios');
    }

    
    public function edit(User $user)
    {
    	return view('users.edit', compact('user'));
    }


    public function update(User $user)
    {


        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => '',
        ]);

        if ($data['password'] != null ){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }


        $user->update($data);

        return redirect()->route('users.show', [ 
            'user' => $user
        ]);
    }    


    public function destroy(User $user)
    {
        
        $user->delete();

        return redirect()->route('users.index');
    }

}
