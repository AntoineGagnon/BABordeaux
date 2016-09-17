@extends('layouts.app')

@section('content')
<div style="margin-bottom:20px;">
    <button type="button" class="btn btn-primary btn-lg">Créer sondage</button>
</div>

<!-- Current Sondages -->
@if (count($sondages) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Sondages
    </div>

    <div class="panel-body">
        <table class="table table-striped table-inverse" >

            <!-- Table Headings -->
            <thead>
                <th>#</th>
                <th>Titre du sondage</th>
                <th class="text-right">Date</th>
                <th class="text-right">Répondre</th>
                <th class="text-right">Editer</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($sondages as $sondage)
                <tr>
                    <!-- Sondage Id -->
                    <th class="row">
                        <div>{{ $sondage->id }}</div>
                    </th>
                    
                    <!-- Sondage Name -->
                    <td>
                        <div>{{ $sondage->title }}</div>
                    </td>
                    
                    <!-- Sondage Date -->
                    <td class="row text-right">
                        <div>date</div>
                    </td>
                    
                    <!-- Edit button Sondage -->
                    <td class="row text-right">
                        <form action="/sondage/edit/{{ $sondage->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('EDIT') }}

                            <button class="btn btn-primary btn-sm">Répondre</button>
                        </form>
                    </td>
                    
                    <td class="row text-right">
                        <form action="/sondage/edit/{{ $sondage->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('EDIT') }}

                            <button class="btn btn-primary btn-sm">Edit</button>
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