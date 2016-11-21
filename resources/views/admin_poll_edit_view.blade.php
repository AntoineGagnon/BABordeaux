@extends('layouts.app')


@section('content')

    @if(!empty($questionAdded))
        <div class="panel panel-success">
            <div class="panel-heading">
                Question ajoutée au sondage !
            </div>
        </div>
    @endif


    <div class="panel panel-default panel-primary">
        <div class="panel-heading">
            <h1>Édition du sondage</h1>
        </div>


        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- Question add form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="glyphicon glyphicon-question-sign"></span>AJOUTER UNE QUESTION</a>
                                </h4>
                            </div>
                            <form action="/question" method="POST">
                                {{ csrf_field() }}
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="question_type">
                                                        Type</label>
                                                    <select class="form-control" id="question_type" name="question_type">
                                                        <option value="openAnswer">Ouverte</option>
                                                        <option value="multipleChoice">Choix multiples</option>
                                                        <option value="singleChoice">Choix uniques</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="Numéro de groupe">
                                                        Numéro de groupe</label>
                                                    <input type="number" class="form-control" id="group_id" name="group_id" placeholder="N°" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="order_num">
                                                        Numéro d'ordre dans le groupe</label>
                                                    <input type="number" class="form-control" id="order_num" name="order_num" placeholder="N°" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="question_label" type="text" name="question_label" class="form-control" placeholder="Titre" required />
                                                </div>
                                                <div id="choices-group" class="form-group">
                                                    <textarea class="form-control choice" name="choix" placeholder="choix" rows="1" style="display:none" ></textarea>
                                                </div>
                                                <button id="btnAddChoice" type="button" class="btn btn-info btn-sm" style="display: none;">
                                                    <span class="glyphicon glyphicon-plus"></span> Choix
                                                </button>
                                                <button id="btnRemoveChoice" type="button" class="btn btn-danger btn-sm" style="display: none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Choix
                                                </button>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right btn-lg" style="margin-top: 1%">Valider</button>

                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                 <span class="glyphicon glyphicon-th-list"></span>SUPPRIMER DES QUESTIONS</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('post-js')
    @parent
    <script>
        $('select').on('change', function() {
            if (this.value == "openAnswer") {
                $(".choice").css("display", "none");
                $("#btnAddChoice").css("display", "none");
                $("#btnRemoveChoice").css("display", "none");
            }
            if (this.value == "singleChoice" || this.value =="multipleChoice") {
                $(".choice").css("display", "inline");
                $("#btnAddChoice").css("display", "inline");
                $("#btnRemoveChoice").css("display", "inline");
            }

        });
        $("#btnAddChoice").click(function(){
            $("#choices-group").append( "<textarea class=\"form-control choice\" name=\"choix\" placeholder=\"choix\" rows=\"1\" ></textarea>" );
        });

        $("#btnRemoveChoice").click(function(){
            $("#choices-group textarea:last-child").remove();
        });
    </script>
@endsection

