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
                    <!-- Titre du sondage -->
                    <td>
                        <div>{{ $sondage->title }}</div>
                    </td>
                    
                    <!-- Date de création du sondage -->
                    <td class="row text-right">
                        <div>{{ date("j-m-Y", $sondage->date ) }}</div>
                    </td>
                    
                    <!-- Bouton pour répondre -->
                    <td class="row text-right">
                        <a href="sondage/{{ $sondage->id }}" class="btn btn-primary btn-sm">Répondre</a>
                    </td>
                    
                    <!-- Bouton pour éditer -->
                    <td class="row text-right">
                        <a href="sondage/{{ $sondage->id }}/edit" class="btn btn-primary btn-sm">Editer</a>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection