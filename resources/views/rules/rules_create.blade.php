@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Créateur de règles</h1>
        </div>

        <div class="panel-body">
            @if(isset($results))
                <div class="alert-success">Nombre d'oeuvres trouvées : {{$results->count()}}</div>
            @endif


            <form action="/rule" id="mainForm" method="POST">
                {{ csrf_field() }}

                <input type="text" class="form-group" id="ruleName" name="ruleName"
                       placeholder="Nom de la règle"/>

                <div id="constraints">


                    <div class="row" id="row0">
                        <div class="form-group col-md-2 ">
                            <select class="form-control attributeSelector" id="attribute0" name="attribute0">
                                @foreach($attributes as $attribute)
                                    <option value="{{$attribute}}">{{$attribute}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-control constraintSelector" id="constraint0" name="constraint0"
                                    title="Règle">
                                <option value="contains">Contient</option>
                                <option value="notcontains">Ne contient pas</option>
                                <option value="begins">Commence par</option>
                                <option value="ends">Finit par</option>
                                <option value="between">Entre nombres</option>
                                <option value="morethan">Supérieur à</option>
                                <option value="lessthan">Inférieur à</option>
                                <option value="equalto">Egal à</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-8">
                            <div class="row" id="values0">
                                <input type="text" class="form-control col-md-6" id="value0" name="value0"
                                       placeholder="Valeur"
                                />
                            </div>
                        </div>

                    </div>
                </div>

                <p>
                    <button class="btn btn-info " id="btnAddConstraint">Ajouter une contrainte</button>
                </p>

                <div class="text-center">
                    <button class="btn btn-success btn-lg" type="submit">Recherche</button>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('post-js')
    @parent
    <script>

        currentQuestion = 0;
        currentConstraint = 0;

        attributes = ["contains", "notcontains", "begins", "ends", "between", "morethan", "lessthan", "equalto"];

        $(document).ready(function () {

            ajoutConstraintButton = $('#btnAddConstraint');
            $("#constraint" + currentConstraint).change(function () {
                ruleVal = $("#constraint" + currentConstraint).val();
                console.log(ruleVal);

                if (ruleVal === "between") {
                    $("#values" + currentConstraint).append("<input type='text' class='form-control col-md-6' id='value_greater' name='value_greater' placeholder='Max' required/>");
                    ajoutConstraintButton.hide();
                } else if (ruleVal === "lessthan") {
                    ajoutConstraintButton.hide();
                } else if (ruleVal === "morethan") {
                    ajoutConstraintButton.hide();
                } else if (ruleVal === "contains" || ruleVal === "notcontains" || ruleVal === "begins" || ruleVal === "ends") {
                }
            });
            @if(isset($attributes))
            $("#btnAddConstraint").click(function () {
                currentConstraint++;
                var largeHTML = '<div class="row" id="row' + currentQuestion + "-" + currentConstraint + '">' +
                    '<div class="form-group col-md-2 "> ' +
                    '<select class="form-control attributeSelector" id="attribute' + currentQuestion + "-" + currentConstraint + '" name="attribute' + currentQuestion + "-" + currentConstraint + '"> ';
                $.each(attributes, function (i, val) {
                    largeHTML += '<option value="' + val + '">' + val + '</option> ';
                });
                largeHTML +=
                    '</select> ' +
                    '</div> ' +
                    '<div class="form-group  col-md-2">' +
                    '<select class="form-control constraintSelector" id="constraint' + currentQuestion + "-" + currentConstraint + '" name="constraint' + currentQuestion + "-" + currentConstraint + '" title="Règle"> ' +
                    '<option value="contains">Contient</option> ' +
                    '<option value="notcontains">Ne contient pas</option> ' +
                    '<option value="begins">Commence par</option> ' +
                    '<option value="ends">Finit par</option> ' +
                    '<option value="between">Entre nombres</option> ' +
                    '<option value="morethan">Supérieur à</option> ' +
                    '<option value="lessthan">Inférieur à</option> ' +
                    '<option value="equalto">Egal à</option> ' +
                    '</select> ' +
                    '</div> ' +
                    '<div class="form-group  col-md-8" > ' +
                    '<div class="row" id="values' + currentQuestion + "-" + currentConstraint + '"> ' +
                    '<input type="text" class="form-control col-md-6" id="value' + currentQuestion + "-" + currentConstraint + '" name="value' + currentQuestion + "-" + currentConstraint + '" placeholder="Valeur" />' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ';

                $("#constraints").append(largeHTML);

            });
            @endif
        })

    </script>

@endsection
