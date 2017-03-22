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

                <div class="form-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>DÉCOUVREZ QUELLE OEUVRE ARTISTIQUE VOUS CORRESPOND !</h3>
                        </div>
                        <div class="panel-body">

                            <div id="next" class="hidden">
                                @foreach($artworks as $artwork)
                                    <img style="width: 50%; height: 50%; float:left;" src="{{$artwork->image_url}}" alt="artwork_image" />

                                    <div style="overflow: hidden; border: double;">
                                        <p>Title: {{$artwork->title}} </p>
                                        <p>Artist: {{$artwork->artist}} ({{$artwork->born_died}}</p>
                                        <p>Date: {{$artwork->date}}</p>
                                        <p>Technique: {{$artwork->technique}}</p>
                                        <p>Type: {{$artwork->type}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div id="first">
                            <h4>Nous vous invitons à découvrir quelle oeuvre artistique vous correspond en commençant par répondre à la question suivante: </h4>
                                <div class="form-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>{{ $questions->first()->label }}@if($questions->first()->isRequired)<span
                                                        style="color: #DA4453;"> *</span>

                                                @endif
                                            </h3>
                                        </div>

                                        @if($questions->first()->questionType == "openAnswer")
                                            <textarea class="form-control" style="resize: none" rows="5"
                                                      @if($questions->first()->isRequired)
                                                      required
                                                      @endif
                                                      name="question_{{ $questions->first()->id }}"></textarea>
                                            <br>
                                        @else

                                            @foreach ($questions->first()->answers as $answer)
                                                @if($questions->first()->questionType == "singleChoice")
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio"
                                                                   @if($questions->first()->isRequired)
                                                                   required
                                                                   @endif
                                                                   name="question_{{ $questions->first()->id }}"
                                                                   value="{{ $answer->id }}"> {{ $answer->label }}
                                                        </label>
                                                    </div>
                                                @elseif($questions->first()->questionType == "multipleChoice")
                                                    <div class="form-check">
                                                        <label class="form-check-label">

                                                            <input class="form-check-input" type="checkbox"
                                                                   name="question_{{ $questions->first()->id }}[]"
                                                                   value="{{ $answer->id }}"> {{ $answer->label }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <button type="button" class="btn btn-info pull-right glyphicon glyphicon-arrow-right next-button" id="nextButton"></button>
                <button type="submit" style="display: none" class="btn btn-primary pull-right btn-lg" id="submitBtn">Valider</button>
            </form>

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
            var progressBar = $('.progress-bar');
            if ({{$questionGroups->count()}} == 1
        )
            {
                value = 100;
            }
        else
            {
                var value = Math.ceil(((page + 1) / {{$questionGroups->count()}}  ) * 100);
            }
            progressBar.css('width', value + '%').attr('aria-valuenow', value);
            progressBar.text(value + "%");
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
            console.log(page);

            jQuery('#first').addClass('hidden');

            page++;
            console.log(page);

            jQuery('#next').removeClass('hidden');

            currentQuestionGroup = $('#question_group_' + questionGroupsList[page]);
            $(currentQuestionGroup).removeClass('hidden');
            updateProgressBar();
        }


    </script>
@endsection