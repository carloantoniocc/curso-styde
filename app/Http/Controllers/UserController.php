<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {

    	$users = [
    		'Joel',
    		'Ellie',
    		'Tess',
    		'<script>alert("Clicker")</script>',


    	];

    	$title = 'Listado de Usuarios';

    	return view('users', compact('users','title'));
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
