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
            <form action="/poll" method="POST">
                {{ csrf_field() }}

                @foreach($questionGroups as $questionGroup)
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
                        <button type="button" class="btn btn-info glyphicon glyphicon-arrow-left "></button>
                    @endif

                    @if(! ($questionGroup == $questionGroups->last()))
                        <button type="button" class="btn btn-info pull-right glyphicon glyphicon-arrow-right"></button>
                    @endif
                    <br>

                @endforeach

                <button type="submit" class="btn btn-primary pull-right btn-lg" id="submitBtn">Valider</button>

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
                /*

         var questionCount =
         $(document).ready(function () {
         // Clic sur #prev-button
         $('#prev-button').unbind('click').click(onPrevButtonClick);

         // Clic sur #next-button
         $('#next-button').unbind('click').click(onNextButtonClick);

         // Clic sur #ok-button
         $('#ok-button').unbind('click').click(onNextButtonClick);
         });

         function onPrevButtonClick() {
         var currentQuestion = $('.question.current');
         var newQuestion = $(currentQuestion).prev('.question');

         $(currentQuestion).removeClass('current').addClass('hidden');
         $(newQuestion).removeClass('hidden').addClass('current');

         updateButtons(newQuestion);
         }

         function onNextButtonClick() {
         var currentQuestion = $('.question.current');
         var newQuestion = $(currentQuestion).next('.question');
         if ($(newQuestion).length == 0)
         return;

         $(currentQuestion).removeClass('current').addClass('hidden');
         $(newQuestion).removeClass('hidden').addClass('current');

         updateButtons(newQuestion);
         }

         function updateButtons(currentQuestion) {
         if ($(currentQuestion).next('.question').length == 0) {
         $('#next-button').addClass('hidden');
         }
         else if ($('#next-button').hasClass('hidden')) {
         $('#next-button').removeClass('hidden');
         }

         if ($(currentQuestion).prev('.question').length == 0) {
         $('#prev-button').addClass('hidden');
         }
         else if ($('#prev-button').hasClass('hidden')) {
         $('#prev-button').removeClass('hidden');
         }
         }*/
    </script>
@endsection