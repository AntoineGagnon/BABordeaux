@extends('layouts.app')

@section('content')

    @if(!empty($questionAdded))
        <div class="panel panel-success notranslate">
            <div class="panel-heading">
                Oeuvre ajoutée à la base de données !
            </div>
        </div>
    @endif

    <div class="panel panel-default panel-primary notranslate">
        <div class="panel-heading">
            <h1>Édition des oeuvres</h1>
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
                                    <span class="glyphicon glyphicon-question-sign"></span>AJOUTER UNE NOUVELLE OEUVRE
                                </h4>
                            </div>
                            <form action="/admin/editartworks" method="POST">
                                {{ csrf_field() }}
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="artist">Artiste</label>
                                                    <input type="text" class="form-control" id="artist" name="artist" placeholder="" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Titre</label>
                                                    <input type="text" class="form-control" id="title" name="title" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="number" class="form-control" id="date" name="date" placeholder="yyyy" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <input type="text" class="form-control" id="type" name="type" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="location">Localisation</label>
                                                    <input type="text" class="form-control" id="location" name="location" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image_url">URL de l'image</label>
                                                    <input id="image_url" type="text" name="image_url" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="OU">OU</label>
                                                    <input id="file_uploader" type="file" name="file_uploader" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="reset" class="btn btn-danger pull-left btn-lg" style="margin-top: 1%">Réinitialiser</button>
                                        <button type="submit" class="btn btn-success pull-right btn-lg" style="margin-top: 1%">Valider</button>
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
                                    <span class="glyphicon glyphicon-th-list"></span>MODIFIER OU SUPPRIMER DES OEUVRES EXISTANTES
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in ">
                                <form action="/admin/updateLabel" method="POST">
                                    {{ csrf_field() }}
                                    <div class="panel-collapse collapse in ">
                                        <div class="panel-body editform">
                                            <div class="row col-md-12">
                                                <div class="form-group" >
                                                    <div>
                                                        <label style="width: 20%; float: left;">Artiste</label>
                                                        <label style="width: 15%; float: left;">Titre</label>
                                                        <label style="width: 8%; float: left;">Date</label>
                                                        <label style="width: 35%; float: left;">Image URL</label>
                                                        <label style="width: 10%; float: left;">Type</label>
                                                    </div>
                                                    @foreach($artworks as $artwork)
                                                        <div class="divdeletequestion">
                                                            <button type="button" value="{{$artwork->id}}" class="btnRemoveQuestion confirm btn btn-danger btn-sm" style="float:right">
                                                                <span class="glyphicon glyphicon-trash"></span> Supprimer
                                                            </button>
                                                        </div>
                                                        @if($artwork->isVisible == 0)
                                                        @elseif($artwork->isVisible == 1)
                                                            <div class="divhidequestion">
                                                                <button type="button" value="{{$artwork->id}}" class="btnHideQuestion btn btn-warning btn-sm" style="float: right; margin-right: 1%;  margin-left: 1%">
                                                                    <span class="glyphicon glyphicon-eye-close"></span> Cacher
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div style=" padding-right: .5em;">
                                                            <input type="text" class="form-control Questionlabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->artist }}" style="width: 20%; float: left;"/>
                                                            <input type="text" class="form-control Questionlabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->title }}" style="width: 15%;float: left;"/>
                                                            <input type="number" class="form-control Questionlabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->date }}" style="width: 8%;float: left;"/>
                                                            <input type="text" class="form-control Questionlabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->image_url }}" style="width: 35%; float:left;"/>
                                                            <input type="text" class="form-control Questionlabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->type }}" style="width: 10%;"/>
                                                        </div>

                                                        <br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success pull-right btn-lg" style="margin-top: 1%">Valider</button>
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

            $('select').on('change', function() {
                if (this.value == "openAnswer") {
                    $(".choice").css("display", "none");
                    $("#btnAddChoice").css("display", "none");
                    $("#btnRemoveChoice").css("display", "none");
                    $("#choices-group :text").attr('required', false);
                }
                if (this.value == "singleChoice" || this.value =="multipleChoice") {
                    $(".choice").css("display", "inline");
                    $("#btnAddChoice").css("display", "inline");
                    $("#btnRemoveChoice").css("display", "inline");
                    $("#choices-group :text").attr('required', true);
                }

            });
            $("#btnAddChoice").click(function(){
                $('#nb_choices').val( function(i, oldval) {
                    return ++oldval;
                });
                countChoice++;
                $("#choices-group").append("<input type='text' class='form-control choice' name='choice" + countChoice + "' placeholder='choix' required/>" );

            });

            $("#btnRemoveChoice").click(function(){
                $("#choices-group input:last-child").remove();
                countChoice--;
                $('#nb_choices').val( function(i, oldval) {
                    return --oldval;
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //delete question
            $('.divdeletequestion').on("click", ".btnRemoveQuestion",function(){
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
                };
            });

            //hide question
            $('.divhidequestion').on("click", ".btnHideQuestion",function(){
                var question_id = $(this).val();
                var show_visibility = 0;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateVisibility/'+question_id+'/'+show_visibility,
                    data: {_id:question_id,_show:show_visibility},
                    success: function() {
                        $(".editform").load(location.href + " .editform*","");
                        console.log("ok hide");
                    },
                    error: function(data) {
                        console.log("error ajax hide: " + data);
                    }
                });
            });

            //show question
            $('.divshowquestion').on("click", ".btnShowQuestion",function(){
                var question_id = $(this).val();
                var show_visibility = 1;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateVisibility/'+question_id+'/'+show_visibility,
                    data: {_id:question_id,_show:show_visibility},
                    success: function(data) {
                        $(".editform").load(location.href + " .editform*","");
                        console.log("ok show");
                    },
                    error: function(data) {
                        console.log("error ajax show: " + data);
                    }
                });
            });

            //question required ON
            $('.divrequiredonquestion').on("click", ".btnIsRequiredON",function(){
                var question_id = $(this).val();
                var isRequired=1;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateRequired/'+question_id+'/'+isRequired,
                    data: {_id:question_id,_required:isRequired},
                    success: function(data) {
                        $(".editform").load(location.href + " .editform*","");
                        console.log("ok required ON");
                    },
                    error: function(data) {
                        console.log("error ajax required ON: " + data);
                    }
                });
            });

            //question required OFF
            $('.divrequiredoffquestion').on("click", ".btnIsRequiredOFF",function(){
                var question_id = $(this).val();
                var isRequired=0;
                $.ajax({
                    type: "POST",
                    url: '/admin/updateRequired/'+question_id+'/'+isRequired,
                    data: {_id:question_id,_required:isRequired},
                    success: function(data) {
                        $(".editform").load(location.href + " .editform*","");
                        console.log("ok required OFF");
                    },
                    error: function(data) {
                        console.log("error ajax required OFF: " + data);
                    }
                });
            });

            function labelChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_changed');
                console.log("changedlabel");
            }
            $(".Questionlabel").on("change", labelChanged);


        }

        $(document).ready(function(){
            initialise();
        });
        $(document).ajaxComplete(function () {
            initialise();
        });

    </script>
@endsection

