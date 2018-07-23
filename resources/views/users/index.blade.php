
@extends('layout')

@section('title', 'Usuario')




@section('content')

	<h1>{{ ($title) }}</h1>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">Listado de Usuarios</div>
					<div class="panel-body">

						@if (! empty($users)) 
							<div class="row">
								<div class="col-md-12">
									<table class="table table-striped">
										<thead>
										  <tr>
											<th >Nombre Usuario</th>
											<th>Email</th>
											<th>Mostrar</th>
										  </tr>
										</thead>
										<tbody>
										  @foreach ($users as $user)
										  <tr>
											<td >{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td><a href="{{ URL::to('usuarios/' . $user->id ) }}">Mostrar</a></td>
										  </tr>
										  @endforeach
										</tbody>
									</table>
								</div>
							</div>



						@else
							<p>No existen usuarios registrados</p>
						@endif


					</div>
			</div>
		</div>	
	</div>


@endsection('content')

@section('sidebar')




@endsection