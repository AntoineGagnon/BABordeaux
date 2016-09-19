@extends('layouts.app')

@section('content')

    <script type="text/javascript">
        var ordre =0;
        var choice =0;
        function addQuestion() {
            var questions = document.getElementById('questions');
            questions.innerHTML ="";
        }

        function addChoice(){
            var parentQuestion = parent.find('div[id^="question"]');
            var qi = parentQuestion.id.match(/\d+$/);
            var choices = document.getElementById('choices' + qi);
            // var ci = $('#choices' + qi).find('input:last').id.match(/\d+$/);
            var input = document.createElement("input");

            input.type="text";
            input.name="choix" + qi + "-" + ci;
            input.addClass("form-control");
            choices.appendChild(input);
        }
    </script>

    <!-- Bootstrap Boilerplate... -->
    <div class="panel panel-default">
        <div class="panel-heading">
            New sondage
        </div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Formulaire de création de sondage -->
            <form action="/sondage" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Nom du sondage -->
                <div class="form-group">
                    <label for="sondage-title" class="col-sm-3 control-label">Titre sondage</label>

                    <div class="col-sm-6">
                        <input type="text" name="titre" id="sondage-titre" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sondage-mdp" class="col-sm-3 control-label">Mot de passe</label>

                    <div class="col-sm-6">
                        <input type="password" name="mdp" id="sondage-mdp" class="form-control">
                    </div>
                </div>

                <!-- Questions -->
                <div class="form-group" id="question1" >

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <input type="text" name="q_label1" class="form-control" placeholder="Intitulé question" >
                        </div>

                        <div class="panel-body" id="choices1">
                            <input type="text" name="choice1_1" class="form-control">
                            <input type="text" name="choice1_2" class="form-control">
                        </div>
                        <button type="button" class="btn btn-default" id="add-choice-q1" onclick="addChoice()">Ajouter un choix (ne pas utiliser)</button>
                    </div>

                </div>

                <div class="form-group" id="question2" >

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <input type="text" name="q_label2" class="form-control" placeholder="Intitulé question" >
                        </div>

                        <div class="panel-body" id="choices2">
                            <input type="text" name="choice2_1" class="form-control">
                            <input type="text" name="choice2_2" class="form-control">

                        </div>
                        <button type="button" class="btn btn-default" id="add-choice-q1" onclick="addChoice()">Ajouter un choix (ne pas utiliser)</button>
                    </div>

                </div>

                <!-- Add Question Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="button" class="btn btn-default" onclick="addQuestion();">Ajouter une question (ne pas utiliser)</button>
                    </div>
                </div>

                <!-- Add Sondage Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-plus">Créer le sondage</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection