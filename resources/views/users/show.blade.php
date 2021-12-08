@extends('layout/application')

@section('content')

	<h1>{{$user->names->first_name . " " .$user->names->first_surname}}</h1>

	<form action="{{route('delete_user')}}" method="POST">
		@method('DELETE')
		@csrf
		
		<input type="submit" value="Borrar Usuario">
	</form>
@endsection