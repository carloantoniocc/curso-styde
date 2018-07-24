
@extends('layout')

@section('title', "Usuario ")

@section('content')

<h1>Editar usuario </h1>


@if ($errors->any())
	<p>Hay errores !!!</p>
@endif

<form method="POST" ACTION="{{ url("usuarios/{$user->id}") }}">
	{{ method_field('PUT') }}
	{!! csrf_field() !!}
	
	<br>
	<label for="">Nombre</label>
	<input type="text" name="name" value=" {{ old('name', $user->name ) }} " placeholder="Joel">	

	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif



	<br>
	<label for="">email</label>
	<input type="email" name="email" value=" {{ old('name', $user->email ) }}" placeholder="Joel@redsalud.gov.cl">
	<br>
	<label for="">password</label>
	<input type="password" name="password" placeholder="Mayor a 6 caracteres">
	<br>
	<button type="submit">Actualizar usuario</button>
	
</form>


@endsection('content')



