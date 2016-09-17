@extends('layouts.app')

@section('content')

<!-- Current Sondages -->
@if (count($sondages) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Sondages
    </div>

    <div class="panel-body">
        <table class="table table-striped sondage-table">

            <!-- Table Headings -->
            <thead>
                <th>Sondage</th>
                <th>&nbsp;</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($sondages as $sondage)
                <tr>
                    <!-- Sondage Name -->
                    <td class="table-text">
                        <div>{{ $sondage->title }}</div>
                    </td>

                    <td>
                        <form action="/sondage/edit/{{ $sondage->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('EDIT') }}

                            <button>Edit Sondage</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection