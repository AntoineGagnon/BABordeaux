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
            <img src="{{ asset('public/artworks_images/guerilla.jpg') }}" alt="artwork_images" />
        </div>

    <!--div class="panel progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
             style="width: 60%;">
            60%
        </div-->
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