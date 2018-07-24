
@extends('layout')

@section('title', 'Usuario')




@section('content')

<br>
<br>

	<div class="d-flex justify-content-between align-items-end mb-3">
	
		<h1 class="pb-1">{{ ($title) }}</h1>

		<p>
			<a class="btn btn-primary" href="{{ route('users.create' ) }}">Nuevo Usuario</a>
		</p>

	</div>

@if ($users->isNotEmpty() ) 
	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre Usuario</th>
	      <th scope="col">Email</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
	  <tbody>

		@foreach ($users as $user)

	    <tr>
	      <th scope="row">{{ $user->id }}</th>
		  <td >{{ $user->name }}</td>
		  <td>{{ $user->email }}</td>
		  <td>
		  	<a href="{{ route('users.show', $user ) }}">Ver Detalles</a> |
		  	<a href="{{ route('users.edit', $user ) }}">Editar</a>
		  	<form action="{{ route('users.destroy', $user ) }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('delete') }}

				<button type="submit">Eliminar</button>													
			</form>
		  </td>
	    </tr>


		@endforeach

	  </tbody>
	</table>

@else
	<p>No existen usuarios registrados</p>
@endif




@endsection('content')

@section('sidebar')




@endsection