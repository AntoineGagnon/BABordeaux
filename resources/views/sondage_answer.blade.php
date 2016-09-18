@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{ $sondage->titre }}</h2>
    </div>

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de création de sondage -->
        <form action="/sondage" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            
            @foreach ($questions as $question)
            
            <div class="form-group">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $question->label }}</h3>
                    </div>

                    <div class="panel-body" id="choices">
                        <button type="button" class="btn btn-default" >Ajouter un choix</button>
                    </div>
                </div>

            </div>
            
            @endforeach
                
        </form>
    </div>
</div>

@endsection