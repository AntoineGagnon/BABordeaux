@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Règles</h1>
        </div>

        <div class="panel-body">
            <a href="/ruleMaker">
                <button class="btn btn-primary">+ Nouvelle règle</button>
            </a>
            <div class="list-group">
                @include('common.errors')
                @foreach ($rules as $rule)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-8">
                                {{$rule->label}}
                            </div>

                            <form action="/rule/{{$rule->id}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger btn-sm col-lg-4"><span
                                            class="glyphicon glyphicon-remove"></span> Supprimer
                                </button>
                                {{method_field('DELETE')}}
                            </form>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
