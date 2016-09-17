@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Sondage Form -->
        <form action="/sondage" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Nom du sondage -->
            <div class="form-group">
                <label for="sondage" class="col-sm-3 control-label">Sondage</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="sondage-title" class="form-control">
                </div>
            </div>

            <!-- Add Sondage Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Sondage
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Sondages -->
@endsection