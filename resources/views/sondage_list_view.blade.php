@extends('layouts.app')

@section('content')
<div style="margin-bottom:20px;">
    <a href="sondage/create" class="btn btn-primary btn-lg">Créer sondage</a>
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
                <th>Titre du sondage</th>
                <th class="text-right">Date</th>
                <th class="text-right">Répondre</th>
                <th class="text-right">Editer</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($sondages as $sondage)
                <tr>
                    <!-- Sondage Name -->
                    <td>
                        <div>{{ $sondage->title }}</div>
                    </td>
                    
                    <!-- Sondage Date -->
                    <td class="row text-right">
                        <div>{{ date("j-m-Y", $sondage->date ) }}</div>
                    </td>
                    
                    <!-- Answer button Sondage -->
                    <td class="row text-right">
                        <a href="sondage/answer/{{ $sondage->id }}" class="btn btn-primary btn-sm">Répondre</a>
                    </td>
                    
                    <!-- Edit button Sondage -->
                    <td class="row text-right">
                        <a href="sondage/edit/{{ $sondage->id }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection