@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Soumissions du livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- For each question, display question name, then results -->

            @foreach ($questions as $question)
                @if($question['answers'] != null)
                    <div class="panel panel-group panel-default">
                        <div class="panel-heading clearfix">
                            <div class="pull-left">
                                {{$question->label}} </div>
                        </div>
                        <div class="panel-body text-center">
                            @if($question->questionType == 'singleChoice')

                                @piechart(strval($question->id), 'chart_' . $question->id,true)

                            @elseif($question->questionType == 'multipleChoice')

                                Nombre moyen de réponses par utilisateur = {{$question->average}}

                                @piechart(strval($question->id), 'chart_' . $question->id,true)

                            @elseif($question->questionType == 'openAnswer')
                                <ul class="list-group">
                                    @foreach($question->answers as $answer)
                                        <li class="list-group-item">{{$answer->label}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

@endsection


@section('post-js')
    $(".spoiler-trigger").click(function() {
    $(this).parent().next().collapse('toggle');
    });
@endsection