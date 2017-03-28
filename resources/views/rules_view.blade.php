@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Règles</h1>
        </div>

        <div class="panel-body">
            @include('common.errors')
            @foreach ($rules as $rule)
                <div class="panel panel-group panel-default">
                    <div class="panel-heading clearfix">
                        <form action="/rule/{{$rule->id}}" class="pull-right" method="POST">
                        </form>
                      <div class="panel-body">{{$rule->label}}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
