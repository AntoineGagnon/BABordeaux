@extends('layouts.app')

@section('content')

    @if (session("submissionWorked"))
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Avis ajouté aux résultats !
        </div>
    @endif

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Sondage du Musée</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de création de sondage -->
            <form action="/poll" method="POST">
                {{ csrf_field() }}

                @foreach($questionGroups as $questionGroup)
                    <div class="panel
                    @if($questionGroup != $questionGroups->first())
                            hidden
                           @endif
                            " id="question_group_{{$questionGroup->id}}">
                        @foreach ($questionGroup->questions as $question)
                            @if($question->isVisible == 1)

                                <div class="form-group">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>{{ $question->label }}@if($question->isRequired)<span
                                                        style="color: #DA4453;"> *</span>

                                                @endif

                                            </h3>
                                        </div>

                                        <div class="panel-body">
                                            @if($question->questionType == "openAnswer")
                                                <textarea class="form-control" style="resize: none" rows="5"
                                                          @if($question->isRequired)
                                                          required
                                                          @endif
                                                          name="question_{{ $question->id }}"></textarea>
                                                <br>
                                            @else

                                                @foreach ($question->answers as $answer)

                                                    @if($question->questionType == "singleChoice")
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio"
                                                                       @if($question->isRequired)
                                                                       required
                                                                       @endif
                                                                       name="question_{{ $question->id }}"
                                                                       value="{{ $answer->id }}"> {{ $answer->label }}
                                                            </label>
                                                        </div>
                                                    @elseif($question->questionType == "multipleChoice")
                                                        <div class="form-check">
                                                            <label class="form-check-label">

                                                                <input class="form-check-input" type="checkbox"
                                                                       name="question_{{ $question->id }}"
                                                                       value="{{ $answer->id }}"> {{ $answer->label }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @endif

                        @endforeach

                        @if(!($questionGroup == $questionGroups->first()))
                            <button type="button"
                                    class="btn btn-info glyphicon glyphicon-arrow-left prev-button" id="prevButton"></button>
                        @endif

                        @if(! ($questionGroup == $questionGroups->last()))
                            <button type="button"
                                    class="btn btn-info pull-right glyphicon glyphicon-arrow-right next-button" id="nextButton"></button>
                        @else
                            <button type="submit" class="btn btn-primary pull-right btn-lg" id="submitBtn">Valider
                            </button>

                        @endif
                        <br>
                    </div>
                @endforeach


            </form>


        </div>

    </div>

    <div class="panel progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
             style="width: 60%;">
            60%
        </div>
    </div>





@endsection


@section('post-js')
    @parent
    <script>


        var page = 0;
        var questionGroupsList = [];

        var i = 0;
        @foreach($questionGroups as $questionGroup)
                questionGroupsList[i] = {{$questionGroup->id}}
                i++;
        @endforeach

        $(document).ready(function () {
            // Clic sur #prev-button
            $('.prev-button').click(onPrevButtonClick);

            // Clic sur #next-button
            $('.next-button').click(onNextButtonClick);

            updateProgressBar();

        });

        function updateProgressBar() {
            var value = 0;
            value = page / ({{$questionGroups->count()}} -1) * 100;
            $('.progress-bar').css('width', value + '%').attr('aria-valuenow', value);
            $('.progress-bar').text(value + "%");
        }

        function onPrevButtonClick() {
            console.log("PrevButtonClicked");
            currentQuestionGroup = $('#question_group_' + questionGroupsList[page]);
            currentQuestionGroup.addClass('hidden');
            console.log(page);

            page--;
            console.log(page);

            currentQuestionGroup = $('#question_group_' + questionGroupsList[page]);
            $(currentQuestionGroup).removeClass('hidden');
            updateProgressBar();

        }

        function onNextButtonClick() {
            console.log("NextButtonClicked");
            currentQuestionGroup = $('#question_group_' + questionGroupsList[page]);
            currentQuestionGroup.addClass('hidden');
            console.log(page);

            page++;
            console.log(page);

            currentQuestionGroup = $('#question_group_' + questionGroupsList[page]);
            $(currentQuestionGroup).removeClass('hidden');
            updateProgressBar();
        }


    </script>
@endsection