@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de d'ajout a livre d'or -->
            <form action="/guestbook" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3><INPUT class="form-control" type="text" name="username" placeholder="Anonymous"></h3>
                            </div>

                            <div class="panel-body">
                                    <INPUT class="form-control" type="text" name="text">
                                    <br>
                            </div>
                        </div>

                    </div>

                <button type="submit" class="btn btn-primary pull-right btn-lg">Valider</button>

            </form>
        </div>
    </div>

@endsection