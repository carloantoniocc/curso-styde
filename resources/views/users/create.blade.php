
@extends('layout')

@section('title', "Usuario ")

@section('content')

<h1>Crear usuario nuevo</h1>

<form method="POST" ACTION="{{ url('usuarios') }}">
	{!! csrf_field() !!}
	
	<br>
	<label for="">Nombre</label>
	<input type="text" name="name">	
	<br>
	<label for="">email</label>
	<input type="email" name="email">
	<br>
	<label for="">password</label>
	<input type="password" name="password">
	<br>
	<button type="submit">Crear usuario</button>
	
</form>


@endsection('content')



