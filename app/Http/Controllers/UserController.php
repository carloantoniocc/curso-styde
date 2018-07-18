<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {

	   	if (request()->has('empty')) {
    		$users =[];
    	}else{
	    	$users = [ 'Joel','Ellie','Tess',];
    	}

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
