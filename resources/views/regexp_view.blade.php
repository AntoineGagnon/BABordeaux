@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Testeur de recherche de tableau</h1>
        </div>

        <div class="panel-body">
            @if(isset($results))

                @foreach($results as $result)

                    <div class="row">{{$result->title}}</div>

                @endforeach


            @else

                <form action="/regexp/search" id="mainForm" method="POST">
                    {{ csrf_field() }}
                        <button class="btn btn-primary" id="btnAddRule">Add rule</button>


                    <div class="row" id="row0">
                        <div class="form-group col-md-2 ">
                            <select class="form-control attributeSelector" id="attribute0" name="attribute0">
                                @foreach($attributes as $attribute)
                                    <option value="{{$attribute}}">{{$attribute}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-2">
                            <select class="form-control ruleSelector" id="rule0" name="rule0" title="Règle">
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
                        <div class="form-group  col-md-8" >
                            <div class="row" id="values0">
                            <input type="text" class="form-control col-md-6" id="value0" name="value0"
                                   placeholder="Valeur"
                                   required/>
                            </div>
                        </div>

                    </div>


                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            @endif

        </div>
    </div>

@endsection

@section('post-js')
    @parent
    <script>

        $(document).ready(function () {

            $("#rule0").change(function () {
                console.log($("#rule0").val());
                if($("#rule0").val() == "between"){
                    $("#values0").append("<input type='text' class='form-control col-md-6' id='value_greater0' name='value_greater0' placeholder='Max' required/>");

                }
            })
            $("#btnAddRule").click(function () {
                console.log($("#rule0").val());

            })
        })

    </script>

@endsection
