
@extends('layout')

@section('title', "Usuario {$user->id} ")

@section('content')

<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Categoria Creada Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Categoria Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
	<br>
	<br>
	<br>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuario</div>
                <div class="panel-body">
                    {{ csrf_field() }} 

					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Nombre</th>
									<th>Mail</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
								  </tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- FIN Lista de Comunas -->
					<p>
						
						<a href="{{ action('UserController@index') }}">Regresar al listado de usuarios</a>
					</p>			
                </div>
            </div>
        </div>
    </div>
</div>



@endsection('content')



