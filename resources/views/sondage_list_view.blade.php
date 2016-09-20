@extends('layouts.app')

@section('content')

    <!-- Current Sondages -->
    @if (count($sondages) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Sondages en cours
            </div>

            <div class="panel-body">
                <table class="table table-striped table-inverse" >

                    <!-- Table Headings -->
                    <thead>
                    <tr>
                        <th>Titre du sondage</th>
                        <th class="text-right">Création</th>
                        <th class="text-right">Modification</th>
                        <th class="text-right">Répondre</th>
                        <th class="text-right">Résultats</th>
                        <th class="text-right">Editer</th>
                    </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($sondages as $sondage)
                        <tr>
                            <!-- Titre du sondage -->
                            <td>
                                <div>{{ $sondage->titre }}</div>
                            </td>

                            <!-- Date de création du sondage -->
                            <td class="row text-right">
                                <div>{{ date_format($sondage->created_at, 'd-m-Y')  }}</div>
                            </td>
                            
                            <!-- Date de création du sondage -->
                            <td class="row text-right">
                                <div>{{ date_format($sondage->updated_at, 'd-m-Y') }}</div>
                            </td>

                            <!-- Bouton pour répondre -->
                            <td class="row text-right">
                                <a href="sondage/{{ $sondage->id }}" class="btn btn-primary btn-sm">Répondre</a>
                            </td>

                             <!-- Bouton pour afficher les résultats -->
                            <td class="row text-right">
                                <a href="sondage/{{ $sondage->id }}/results" class="btn btn-primary btn-sm">Résultats</a>
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