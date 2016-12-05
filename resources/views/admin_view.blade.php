@extends('layouts.app')


@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Panneau administrateur</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="btn-group-vertical btn-group-lg col-lg-12 col-xs-12 col-md12 col-sm-12" role="group"
                 aria-label="...">
                <a href="/admin/editpoll" type="button" class="btn btn-default btn-danger btn-block">Editer le
                    questionnaire</a>
                <a href="/admin/resultpoll" type="button" class="btn btn-default btn-info btn-block">Visualiser les
                    résultats du questionnaire</a>
                <a href="/admin/exportresults" type="button" class="btn btn-default btn-success btn-block">Exporter les résultats du
                    questionnaire</a>
                <a href="/admin/resultguestbook" type="button" class="btn btn-default btn-warning btn-block">Visualiser
                    le Livre d'or</a>
                <a href="/admin/change_password" type="button" class="btn btn-default btn-warning btn-block">Modifier le mot de passe d'administration</a>
                <a href="/logout" type="button" class="btn btn-default btn-warning btn-block">Déconnexion</a>
            </div>
        </div>
    </div>

@endsection