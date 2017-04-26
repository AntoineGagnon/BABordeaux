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
            <h1>Découvrez quelle oeuvre vous correspond !</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- Formulaire de création de sondage -->
            <form action="/poll" method="POST">
                {{ csrf_field() }}

                <h4>Nous vous invitons à découvrir quelle oeuvre artistique vous correspond en commençant par répondre à
                    la question suivante: </h4>


                {{--<div id="next" class="hidden">--}}
                {{--@foreach($artworks as $artwork)--}}
                {{--<img style="width: 50%; height: 50%; float:left;" src="{{$artwork->image_url}}" alt="artwork_image" />--}}

                {{--<div style="overflow: hidden; border: double;">--}}
                {{--<p>Title: {{$artwork->title}} </p>--}}
                {{--<p>Artist: {{$artwork->artist}} ({{$artwork->born_died}}</p>--}}
                {{--<p>Date: {{$artwork->date}}</p>--}}
                {{--<p>Technique: {{$artwork->technique}}</p>--}}
                {{--<p>Type: {{$artwork->type}}</p>--}}
                {{--</div>--}}
                {{--@endforeach--}}
                {{--</div>--}}
                <div class="form-group">
                    @foreach($questions as $question)
                        <div class="panel panel-default @if($question != $questions->first()) hide @endif "
                             id="question_id_{{$question->id}}">
                            <div class="panel-heading">
                                <h3>{{ $question->label }}@if($question->is_required)<span
                                            style="color: #DA4453;"> *</span>@endif
                                </h3>
                            </div>
                            <div class="panel-body">
                                @if($question->question_type == "openAnswer")
                                    <textarea class="form-control" style="resize: none" rows="5"
                                              @if($question->isRequired)required
                                              @endif name="question_{{ $question->id }}"></textarea>
                                    <br>
                                @else
                                    @if($question->question_type == "singleChoice")
                                        @foreach ($question->answers as $answer)

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio"
                                                           @if($question->isRequired)
                                                           required
                                                           @endif
                                                           name="question_{{ $question->id }}[]"
                                                           value="{{ $answer->id }}"> {{ $answer->label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @elseif($question->question_type == "multipleChoice")
                                        @foreach ($question->answers as $answer)

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="question_{{ $question->id }}[]"
                                                           value="{{ $answer->id }}"> {{ $answer->label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


                <button type="button" class="btn btn-info pull-right glyphicon glyphicon-arrow-right next-button"
                        id="nextButton"></button>
                <button type="submit" class="btn btn-primary pull-right btn-lg hide" id="submitBtn">Valider</button>

            </form>

        </div>

        <div class="panel progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 60%;">
                60%
            </div>
        </div>
    </div>

@endsection


@section('post-js')
    @parent
    <script>
        var page = 0;
        var questionsList = [];

        var i = 0;
        @foreach($questions as $question)
            questionsList[i] = {{$question->id}};
            i++;
        @endforeach

        $(document).ready(function () {
            //Clic sur #next-button
            nextButton = $('.next-button');
            nextButton.click(onNextButtonClick);

            //Clic sur #submitBtn
            $('.submitBtn').click(submitAnswer);

            //updateProgressBar();

        });

        function updateProgressBar() {
            var progressBar = $('.progress-bar');
            {{--if ({{$questionGroups->count()}} == 1)--}}
            {{--{--}}
                {{--value = 100;--}}
            {{--}--}}
        {{--else--}}
            {{--{--}}
                {{--var value = Math.ceil(((page + 1) / {{$questionGroups->count()}}  ) * 100);--}}
            {{--}--}}
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
            submitAnswer();
            console.log("NextButtonClicked");
            //console.log("page " + page);
            currentQuestion = $('#question_id_' + questionsList[page]);
            currentQuestion.addClass('hide');

            page++;
            console.log("page " + page);
            currentQuestion = $('#question_id_' + questionsList[page]);

            $(currentQuestion).removeClass('hide');
            //updateProgressBar();
            if (page + 1 == i) {
                jQuery('#nextButton').addClass('hide');
                jQuery('#submitBtn').removeClass('hide');
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        function submitAnswer() {
            //on récupère l'id du bouton coché (qui est l'id de la réponse)
            console.log("SubmitAnswer");
            var answer_id = $('input[name=question_' + questionsList[page] + '\\[\\]]:checked').val();
            $.ajax({
                type: 'GET',
                url: '/getArtworkFromAnswer/' + answer_id,
                data: {id: answer_id},
                //dataType : 'text'
                success: function (response) {
                    alert("Label.id");
                    //les trucs à faire au retour
                    console.log("ok submitAnswer");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


    </script>
@endsection