@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Authentification</h1>
	</div>

	<div class="panel-body">
		<form action="/login/authenticate" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label>
					Mot de passe d'administration
					<input type="password" name="_password">
				</label>

				<input type="submit" name="_submit">
			</div>   
		</form>
	</div>
</div>
@endsection