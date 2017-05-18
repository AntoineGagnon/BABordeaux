@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Résultats du questionnaire</h1>
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
                            @if($question->question_type == 'singleChoice')

                                @piechart(strval($question->id), 'chart_' . $question->id,true)

                            @elseif($question->question_type == 'multipleChoice')

                                Nombre moyen de réponses par utilisateur = {{$question->average}}

                                @piechart(strval($question->id), 'chart_' . $question->id,true)

                            @elseif($question->question_type == 'openAnswer')
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
    @parent
    <script>
        $(document).ready(function(){
            $(".spoiler-trigger").click(function() {
                $(this).parent().next().collapse('toggle');
            });
        });

    </script>
@endsection