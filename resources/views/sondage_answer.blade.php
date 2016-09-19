@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>{{ $sondage->titre }}</h1>
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

                    <div class="panel-body">
                        
                         @foreach ($question->choices as $choice)
                        <INPUT class="radio-inline" type="radio" name="{{ $question->id }}" value= "{{ $choice->label }}" > {{ $choice->label }}
                        <br>
                        @endforeach
                    </div>
                </div>

            </div>
            
            @endforeach
            <button type="button" class="btn btn-primary pull-right btn-lg" >Valider</button>
                
        </form>
    </div>
</div>

@endsection