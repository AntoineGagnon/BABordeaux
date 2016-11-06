@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Sondage du Musée des Beaux Arts</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de création de sondage -->
            <form action="/poll" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                @foreach ($questions as $question)

                    <div class="form-group">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>{{ $question->label }}</h3>
                            </div>

                            <div class="panel-body">

                                @foreach ($question->answers as $answer)
                                    <INPUT class="radio-inline" type="radio" name="{{ $question->id }}" value= "{{ $answer->label }}" > {{ $answer->label }}
                                    <br>
                                @endforeach
                            </div>
                        </div>

                    </div>

                @endforeach
                <button type="submit" class="btn btn-primary pull-right btn-lg" >Valider</button>

            </form>
        </div>
    </div>

@endsection