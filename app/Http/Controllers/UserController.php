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

    public function show($id)
    {
    	return "Mostrando detalle del usuario: {$id}";
    }

    public function create()
    {
    	return 'Crear usuario nuevo';
    }
    
    public function edit($id)
    {
    	return "usuario {$id} ha sido modificado";
    }

}
