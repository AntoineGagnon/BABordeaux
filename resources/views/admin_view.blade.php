@extends('layouts.app')


@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Panneau administrateur</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="btn-group-vertical btn-group-lg " role="group" aria-label="...">
                <a href="/admin/editpoll" type="button" class="btn btn-default btn-danger btn-block">Editer le questionnaire</a>
                <a href="/admin/resultpoll" type="button" class="btn btn-default btn-info btn-block" >Visualiser des résultats du questionnaire</a>
                <a href="" type="button" class="btn btn-default btn-success btn-block">Exporter les résultats du questionnaire</a>
                <a href="/admin/resultguestbook" type="button" class="btn btn-default btn-warning btn-block">Visualiser le Livre d'or</a>

            </div>

        </div>
    </div>

@endsection