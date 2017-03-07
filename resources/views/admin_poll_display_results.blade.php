@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Soumissions du livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- For each question, display question name, then results -->

            @foreach ($questions as $question)
                @if($question['answers'] != null)
                    <div class="panel panel-group panel-default">
                        <div class="panel-heading clearfix">
                            <div class="pull-left">
                                {{$question->label}} </div>


                        </div>
                        <div class="panel-body">
                            @if($question->questionType == 'singleChoice')

                                @piechart(strval($question->id), 'chart_' . $question->id,true)

                            @endif
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

@endsection