@extends('layouts.app_dash')
@section('content2')
    <div class="template-demo mt-4">
        <a href="{{ route('deletePenal.dash',[ 'id'=>$id ]) }}"  class="btn btn-danger btn-lg">Valider Suppression</a>
        <br>
        <a href="{{ route('afficherListePenalite.dash') }}"  class="btn btn-primary btn-lg">Retour</a>

    </div>
@stop