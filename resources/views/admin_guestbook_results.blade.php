@extends('layouts.app')

@section('content')

    <div class="panel panel-primary notranslate">
        <div class="panel-heading">
            <h1>Soumissions du livre d'or</h1>
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            @foreach ($guestbook_submissions as $submission)
                <div class="panel panel-group panel-default">
                    <div class="panel-heading clearfix">
                        <form action="/guestbook/{{$submission->id}}" class="pull-right" method="POST">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger btn-sm"><span
                                        class="glyphicon glyphicon-remove"></span></button>
                            {{method_field('DELETE')}}
                        </form>
                        <div class="pull-left">
                            {{$submission->username}} le {{$submission->created_at->format('d-m-Y à H:i')}}</div>

                    </div>
                    <div class="panel-body">{{$submission->text}}</div>
                </div>
            @endforeach

        </div>
    </div>

@endsection