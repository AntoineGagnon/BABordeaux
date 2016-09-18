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
        var choices = document.getElementById('choices');
        choices.innerHTML += '<input type="text" name="'+choice+'" class="form-control" placeholder="choice">';
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
        <form action="/sondage/store" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Nom du sondage -->
            <div class="form-group">
                <label for="sondage-title" class="col-sm-3 control-label">Titre sondage</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="sondage-title" class="form-control">
                </div>
            </div>

                <div class="form-group">
                    <label for="sondage-mdp" class="col-sm-3 control-label">Mot de passe</label>

                    <div class="col-sm-6">
                        <input type="password" name="mdp" id="sondage-mdp" class="form-control">
                    </div>
                </div>

            <!-- Questions -->
            <div class="form-group" id="questions">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="text" name="label" class="form-control" placeholder="Label" >
                    </div>

                    <div class="panel-body" id="choices">
                        <button type="button" class="btn btn-default" onclick="addChoice();">Ajouter un choix</button>
                    </div>
                </div>
            
            </div>

            <!-- Add Question Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="button" class="btn btn-default" onclick="addQuestion();">Ajouter une question</button>
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


<!-- TODO: Current Sondages -->
@endsection