@extends('layouts.app')

@section('content')

    @if (session("questionAdded"))
        <div class="panel panel-success notranslate">
            <div class="panel-heading">
                Question ajoutée au sondage !
            </div>
        </div>
    @endif

    <div class="panel panel-default panel-primary notranslate">
        <div class="panel-heading">
            <h1>Édition du sondage</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Question add form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="glyphicon glyphicon-question-sign"></span>AJOUTER UNE QUESTION
                                </h4>
                            </div>
                            <form action="/question" method="POST">
                                {{ csrf_field() }}
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="question_type">Type</label>
                                                    <select class="form-control" id="question_type"
                                                            name="question_type">
                                                        <option value="openAnswer">Ouverte</option>
                                                        <option value="multipleChoice">Choix multiples</option>
                                                        <option value="singleChoice">Choix uniques</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="order_num">Numéro d'ordre de la question</label>
                                                    <input type="number" class="form-control" id="order_num"
                                                           name="order_num" placeholder="N°" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="question_label" type="text" name="question_label"
                                                           class="form-control" placeholder="Titre" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="choices-group" class="form-inline" style="display: none">
                                                    <div class="form-group">
                                                        <input type="text" class="choice form-control" name="choice0"
                                                               placeholder="choix"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            Règle associée
                                                            <select name="rule_0" class="form-control">
                                                                @foreach($rules as $rule)
                                                                    <option value="{{$rule->id}}">{{$rule->label}}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="btnAddChoice" type="button" class="btn btn-info btn-sm"
                                                        style="display: none;">
                                                    <span class="glyphicon glyphicon-plus"></span> Choix
                                                </button>
                                                <button id="btnRemoveChoice" type="button" class="btn btn-danger btn-sm"
                                                        style="display: none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Choix
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-check-label">Question obligatoire: </label>
                                                    <label> Oui </label><input type="radio" name="is_required" required
                                                                               value="1"/>
                                                    <label> Non </label><input type="radio" name="is_required"
                                                                               value="0"/>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right btn-lg"
                                                style="margin-top: 1%">Valider
                                        </button>
                                    </div>
                                </div>
                                <input value="0" type="hidden" class="form-control" id="nb_choices" name="nb_choices"/>

                            </form>
                        </div>
                    </div>

                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="glyphicon glyphicon-th-list"></span>MODIFIER OU SUPPRIMER DES QUESTIONS OU RÉPONSES
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in ">
                                <form action="/admin/updateLabel" method="POST">
                                    {{ csrf_field() }}
                                    <div class="panel-collapse collapse in ">
                                        <div class="panel-body editform">
                                            <div class="row col-md-12">
                                                <div class="form-group">
                                                    @foreach($questions as $question)
                                                        <div class="divdeletequestion">
                                                            <button type="button" value="{{$question->id}}"
                                                                    class="btnRemoveQuestion confirm btn btn-danger btn-sm"
                                                                    style="float:right">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                                Supprimer
                                                            </button>
                                                        </div>
                                                        @if($question->is_visible == 0)
                                                            <div class="divshowquestion">
                                                                <button type="button" value="{{$question->id}}"
                                                                        class="btnShowQuestion btn btn-warning btn-sm"
                                                                        style="float: right; margin-right: 1%;  margin-left: 1%">
                                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                                    Afficher
                                                                </button>
                                                            </div>
                                                        @elseif($question->is_visible == 1)
                                                            <div class="divhidequestion">
                                                                <button type="button" value="{{$question->id}}"
                                                                        class="btnHideQuestion btn btn-warning btn-sm"
                                                                        style="float: right; margin-right: 1%;  margin-left: 1%">
                                                                    <span class="glyphicon glyphicon-eye-close"></span>
                                                                    Cacher
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @if($question->is_required == 0)
                                                            <div class="divrequiredonquestion">
                                                                <button type="button" value="{{$question->id}}"
                                                                        class="btnIsRequiredON btn btn-info btn-sm"
                                                                        style="float: right;  margin-left: 1%">
                                                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                                    Rendre Obligatoire
                                                                </button>
                                                            </div>
                                                        @elseif($question->is_required == 1)
                                                            <div class="divrequiredoffquestion">
                                                                <button type="button" value="{{$question->id}}"
                                                                        class="btnIsRequiredOFF btn btn-info btn-sm"
                                                                        style="float: right;  margin-left: 1%">
                                                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                                    Rendre non obligatoire
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div style="overflow: hidden; padding-right: .5em;">
                                                            <input type="text" class="form-control Questionlabel"
                                                                   name="question_{{ $question->id }}"
                                                                   value="{{ $question->label }}" style="width: 100%"/>
                                                        </div>
                                                        @foreach($question->answers as $answer)
                                                            <br>
                                                            <div class="divdeleteanswer">
                                                                <button type="button" value="{{$answer->id}}"
                                                                        class="btnRemoveAnswer confirm btn btn-danger btn-sm"
                                                                        style="float:left; margin-right:2%;">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                    Supprimer
                                                                </button>
                                                            </div>
                                                            <div style="overflow: hidden; padding-right: .5em;">
                                                                <input type="text" class="form-control Answerlabel"
                                                                       name="answer_{{ $answer->id }}"
                                                                       value="{{ $answer->label }}" />
                                                            </div>
                                                        @endforeach
                                                        <br>
                                                        <br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success pull-right btn-lg"
                                                    style="margin-top: 1%">Valider
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
        function initialise() {
            var countChoice = 0;

            var html = '<div class="form-group" >' +
                    '<label>' +
                    'Règle associée ' +
                    '<select name="rule_0" class="form-control">' +
                    '@foreach($rules as $rule)' +
                    '<option value="{{$rule->id}}">{{$rule->label}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</label>' +
                    '</div>';

            $('select').on('change', function () {
                if (this.value == "openAnswer") {
                    $("#choices-group").css("display", "none");
                    $("#btnAddChoice").css("display", "none");
                    $("#btnRemoveChoice").css("display", "none");
                    $("#choices-group :text").attr('required', false);
                }
                if (this.value == "singleChoice" || this.value == "multipleChoice") {
                    $("#choices-group").css("display", "inline");
                    $("#btnAddChoice").css("display", "inline");
                    $("#btnRemoveChoice").css("display", "inline");
                    $("#choices-group :text").attr('required', true);
                }

            });
            $("#btnAddChoice").click(function () {
                $('#nb_choices').val(function (i, oldval) {
                    return ++oldval;
                });
                countChoice++;
                $("#choices-group").append("</br> <input type='text' class='form-control choice' name='choice" + countChoice + "' placeholder='choix' required/>");



                $("#choices-group").append(html);
            });

            $("#btnRemoveChoice").click(function () {
                $("#choices-group input:last-child").remove();
                countChoice--;
                $('#nb_choices').val(function (i, oldval) {
                    return --oldval;
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //delete question
            $('.divdeletequestion').on("click", ".btnRemoveQuestion", function () {
                var question_id = $(this).val();
                if (confirm("Êtes-vous sûr de vouloir supprimer cette question ? (irréversible) ")) {
                    $.ajax({
                        type: "POST",
                        url: '/question/' + question_id,
                        data: {_method: 'delete', _id: question_id},
                        success: function (data) {
                            $(".editform").load(location.href + " .editform*", "");
                            console.log("ok delete");
                        },
                        error: function (data) {
                            console.log("error ajax delete: " + data);
                        }
                    })
                }
                ;
            });

            //hide question
            $('.divhidequestion').on("click", ".btnHideQuestion", function () {
                var question_id = $(this).val();
                var show_visibility = 0;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateVisibility/' + question_id + '/' + show_visibility,
                    data: {_id: question_id, _show: show_visibility},
                    success: function () {
                        $(".editform").load(location.href + " .editform*", "");
                        console.log("ok hide");
                    },
                    error: function (data) {
                        console.log("error ajax hide: " + data);
                    }
                });
            });

            //show question
            $('.divshowquestion').on("click", ".btnShowQuestion", function () {
                var question_id = $(this).val();
                var show_visibility = 1;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateVisibility/' + question_id + '/' + show_visibility,
                    data: {_id: question_id, _show: show_visibility},
                    success: function (data) {
                        $(".editform").load(location.href + " .editform*", "");
                        console.log("ok show");
                    },
                    error: function (data) {
                        console.log("error ajax show: " + data);
                    }
                });
            });

            //question required ON
            $('.divrequiredonquestion').on("click", ".btnIsRequiredON", function () {
                var question_id = $(this).val();
                var isRequired = 1;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateRequired/' + question_id + '/' + isRequired,
                    data: {_id: question_id, _required: isRequired},
                    success: function (data) {
                        $(".editform").load(location.href + " .editform*", "");
                        console.log("ok required ON");
                    },
                    error: function (data) {
                        console.log("error ajax required ON: " + data);
                    }
                });
            });

            //question required OFF
            $('.divrequiredoffquestion').on("click", ".btnIsRequiredOFF", function () {
                var question_id = $(this).val();
                var isRequired = 0;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateRequired/' + question_id + '/' + isRequired,
                    data: {_id:question_id, _required:isRequired},
                    success: function (data) {
                        $(".editform").load(location.href + " .editform*", "");
                        console.log("ok required OFF");
                    },
                    error: function (data) {
                        console.log("error ajax required OFF: " + data);
                    }
                });
            });

            function questionLabelChanged() {
                var name = $(this).attr('name');
                $(this).attr('name', name + '_questionchanged');
                console.log("changedquestionlabel");
            }

            $(".Questionlabel").on("change", questionLabelChanged);

            function answerLabelChanged() {
                var name = $(this).attr('name');
                $(this).attr('name', name + '_answerchanged');
                console.log("changedanswerlabel");
            }

            $(".Answerlabel").on("change", answerLabelChanged);

        }

        $(document).ready(function () {
            initialise();
        });
        $(document).ajaxComplete(function () {
            initialise();
        });

    </script>
@endsection

