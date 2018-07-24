
@extends('layout')

@section('title', "Usuario ")

@section('content')

<br>	
<br>

	<div class="card">
		<h4 class="card-header">Crear usuario nuevo</h4>
		<div class="card-body">
			
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif


			<form method="POST" ACTION="{{ url('usuarios') }}">
				{!! csrf_field() !!}


			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

			  </div>

			  <div class="form-group">
				<label for="">Nombre</label>
				<input type="text" class="form-control" name="name" aria-describedby="" placeholder="Enter nombre">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

			  </div>

			  <div class="form-group">
				<label for="">password</label>
				<input type="password" class="form-control" name="password" >
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

			  </div>

				
				<button type="submit" class="btn btn-primary">Crear usuario</button>
				<a class="btn btn-link" href="{{ route('users.index' ) }}">Regresar al listado de usuarios</a>

			</form>



		</div>
	</div>




@endsection('content')



