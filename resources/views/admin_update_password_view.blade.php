@extends('layouts.app')

@section('content')

	<div class="panel panel-primary notranslate">
	<div class="panel-heading">
		<h1>Modifier le mot de passe d'administration</h1>
	</div>

	<div class="panel-body">
		<form action="/admin/postPasswordChange" method="POST">
			{{ csrf_field() }}
			
			@if (Session::has('message'))
				<p>{!! session('message') !!}</p>
			@endif
			<div class="form-group">
				<label>
					Nouveau mot de passe
					<input type="password" name="_password">
				</label>

				<label>
					Confirmer le mot de passe
					<input type="password" name="_passwordConfirmation">
				</label>

				<input type="submit" name="_submit">
			</div>   
		</form>
	</div>
</div>
@endsection