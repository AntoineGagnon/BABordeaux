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

                    <a href="/rule/{{$rule->id}}" class=" list-group-item">
                        {{$rule->label}}
                    </a>

                @endforeach
            </div>

        </div>
    </div>
@endsection
