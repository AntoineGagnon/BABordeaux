@extends('layouts.app')

@section('content')

    @if (session("artworkAdded"))
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
                            <form action="/artwork" method="POST">
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
                                <form action="/admin/updateArtwork" method="POST">
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
                                                        <div style=" padding-right: .5em;">
                                                            <input type="text" class="form-control ArtistLabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->artist }}" style="width: 20%; float: left;"/>
                                                            <input type="text" class="form-control TitleLabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->title }}" style="width: 15%;float: left;"/>
                                                            <input type="number" class="form-control DateLabel" name="artwork_{{ $artwork->id }}" value="{{ $artwork->date }}" style="width: 8%;float: left;"/>
                                                            <input type="text" class="form-control UrlChanged" name="artwork_{{ $artwork->id }}" value="{{ $artwork->image_url }}" style="width: 35%; float:left;"/>
                                                            <input type="text" class="form-control TypeChanged"  name="artwork_{{ $artwork->id }}" value="{{ $artwork->type }}" style="width: 10%;"/>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //delete question
            $('.divdeletequestion').on("click", ".btnRemoveQuestion",function(){
                var artwork_id = $(this).val();
                if (confirm("Êtes-vous sûr de vouloir supprimer cette oeuvre ? (irréversible) ")) {
                    $.ajax({
                        type: "POST",
                        url: '/artwork/' + artwork_id,
                        data: {_method: 'delete', _id: artwork_id},
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

            function artistChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_artistchanged');
                console.log("_artistchanged");
            }
            $(".ArtistLabel").on("change", artistChanged);

            function titleChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_titlechanged');
                console.log("_titlechanged");
            }
            $(".TitleLabel").on("change", titleChanged);

            function dateChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_datechanged');
                console.log("_datechanged");
            }
            $(".DateLabel").on("change", dateChanged);

            function urlChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_urlchanged');
                console.log("_urlchanged");
            }
            $(".UrlChanged").on("change", urlChanged);

            function typeChanged(){
                var name = $(this).attr('name');
                $(this).attr('name', name + '_typechanged');
                console.log("_typechanged");
            }
            $(".TypeChanged").on("change", typeChanged);



        }

        $(document).ready(function(){
            initialise();
        });
        $(document).ajaxComplete(function () {
            initialise();
        });

    </script>
@endsection

