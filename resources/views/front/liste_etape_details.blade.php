<?php
use Illuminate\Support\Facades\Session;

$url = config('app.url');
$equipe_id=Session::get('equipe_id');
?>

@extends('layouts.app_front')
@section('content')


    <div class="container">
<h1>Equipe : {{ $etapes->first()->nom_equipe }}</h1>
@foreach($etapes->groupBy('nom_etape') as $etapes=>$coureurs)
  
    <table class="table table-striped table-hover">
    <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Temps Chrono</th>

    </tr>
  </thead>
  <tbody>

  <p>{{ $etapes }} {{ $coureurs->first()->nb_coureur }} coureurs</p>


  @foreach ($coureurs as $pt)

  <tr>
      <td>{{ $pt->nom_coureur }}</td>
      <td>{{ $pt->duree }}</td>

    </tr>
    
@endforeach
  </tbody>
    </table>

    <form method="GET" action="{{route('formCoureur.front',[ 'id_etapes'=>$coureurs->first()->id_etape ]) }})}}">
        <input type="hidden" id="id_coureurs" name="id_coureurs" value="{{ $coureurs->first()->id_coureur }}">
    <button type="submit" class="btn btn-success" >Ajouter coureur</button>
    </form>
    <br>
@endforeach

</div>
   
@stop