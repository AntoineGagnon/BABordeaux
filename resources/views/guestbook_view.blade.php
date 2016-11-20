@extends('layouts.app')

@section('content')

    @if (!empty($submissionWorked))
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Avis ajouté au livre d'or !
        </div>
    @endif
    <div class="panel panel-default panel-primary">
        <div class="panel-heading">
            <h1>Livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de d'ajout a livre d'or -->
            <form action="/guestbook" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username">Nom</label>
                    <INPUT class="form-control" type="text" name="username" placeholder="Anonymous">
                </div>

                <div class="form-group">
                    <label for="text">Votre avis</label>

                    <textarea class="form-control" style="resize:none ; min-height:20em" type="text"
                              name="text"></textarea>
                    <br>
                </div>


                <button type="submit" class="btn btn-primary pull-right btn-lg">Valider</button>

            </form>
        </div>
    </div>

@endsection