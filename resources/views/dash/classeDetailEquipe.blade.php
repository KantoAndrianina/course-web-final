@extends('layouts.app_dash')
@section('content2')
<div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Classement Detail Equipe {{ $classeG[0]->nom_equipe }}</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
            <thead>
    <thead>
    <tr>
     <th scope="col">nom_etape</th>   
     <th scope="col">nom_coureur</th>   
     <th scope="col">nom_equipe</th>   
     <th scope="col">duree</th>   
     <th scope="col">penalite</th>   
     <th scope="col">temps final</th>   
     <th scope="col">points</th>     
    </tr>
  </thead>
  <tbody>
  @foreach ($classeG as $pt)

    <tr>
      <td>{{ $pt->nom_etape }}</td>
      <td>{{ $pt->nom_coureur }}</td>
      <td>{{ $pt->nom_equipe }}</td>
      <td>{{ $pt->duree }}</td>
      <td>{{ $pt->penalite }}</td>
      <td>{{ $pt->temps_final }}</td>
      @if($pt->points == 0)
        <td class="align-right"><span style="color: black">{{ $pt->points }} </span></td>
      @else
      <td>{{ $pt->points }}</td>
      @endif
    </tr>
    @endforeach
   
  </tbody>
    </table>
    <br>
    <a href="{{route('afficherClassementGEquipe.dash')}}">Retour</a>
    </div>
        </div>
      </div>
     
    </div>
@stop