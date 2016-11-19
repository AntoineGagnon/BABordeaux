@extends('layouts.app')

@section('content')

    <div class="panel panel-default panel-primary">
        <div class="panel-heading">
            <h1>Livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de d'ajout a livre d'or -->
            <form action="/guestbook" method="POST" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username">Nom</label>
                    <INPUT class="form-control" type="text" name="username" placeholder="Anonymous">
                </div>

                <div class="form-group">
                    <label for="text">Votre avis</label>

                    <textarea class="form-control" type="text" name="text"></textarea>
                    <br>
                </div>


                <button type="submit" class="btn btn-primary pull-right btn-lg">Valider</button>

            </form>
        </div>
    </div>

@endsection