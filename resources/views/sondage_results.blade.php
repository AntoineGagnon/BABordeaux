@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Résulats du sondage {{ $sondage->titre }}</h1>
    </div>

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')


            @foreach ($questions as $question)
            
            <div class="form-group">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $question->label }}</h3>
                    </div>

                    <div class="panel-body">

                        @foreach ($question->choices as $choice)
                        <h4> {{ $choice->label }} : {{ $results[$choice->label] }} votes</h4>
                        @endforeach
                    </div>
                </div>

            </div>
            
            @endforeach

    </div>
</div>

@endsection