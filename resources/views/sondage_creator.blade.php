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

        <!-- New Sondage Form -->
        <form action="/sondage" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Nom du sondage -->
            <div class="form-group">
                <label for="sondage" class="col-sm-3 control-label">Titre sondage</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="sondage-title" class="form-control">
                </div>
            </div>

            <!-- Questions -->
            <div id="questions">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="text" name="label" class="form-control" placeholder="Label" >
                    </div>

                    <div class="panel-body" id="choices">
                        <button type="button" class="btn btn-default" onclick="addChoice();">Add Choice</button>
                    </div>
                </div>
            
            </div>

            <!-- Add Question Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="button" class="btn btn-default" onclick="addQuestion();">Add Question</button>
                </div>
            </div>

            <!-- Add Sondage Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa fa-plus">Add Sondage</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- TODO: Current Sondages -->
@endsection