
@extends('layout')

@section('title', 'Usuario')




@section('content')

	<h1>{{ ($title) }}</h1>

	@if (! empty($users)) 
	<ul>
		@foreach ($users as $user)
			<li> {{ ($user) }}</li>

		@endforeach 
	@else
		<p>No existen usuarios registrados</p>
	@endif

	</ul>

@endsection('content')

@section('sidebar')

@parent

<h2>Barra perzonalizada</h2>
@endsection