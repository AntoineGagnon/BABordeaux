@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Règles</h1>
        </div>

        <div class="panel-body">
            <form action="ruleMaker" method="get">
                <button class="btn btn-primary">+ Nouvelle règle</button>
            </form>

            <div class="list-group">
                @include('common.errors')
                @foreach ($rules as $rule)
                <div class="list-group-item">
                  <a href="/rule/{{$rule->id}}">
                    {{$rule->label}}
                  </a>

                  <form action="/rule/{{$rule->id}}" class="pull-right" method="POST">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger btn-sm"><span
                      class="glyphicon glyphicon-remove"></span> Supprimer</button>
                      {{method_field('DELETE')}}
                    </form>
                  </div>
                    <!--<form action="rule/{{$rule->id}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm"><span
                                   class="glyphicon glyphicon-trash"></span> Supprimer</button>
                    </form>-->
                @endforeach
            </div>

        </div>
    </div>
@endsection
