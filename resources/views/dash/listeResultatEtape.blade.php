@extends('layouts.app_dash')
@section('content2')
<div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Classement Etapes Toutes Catégories</h4>
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
      <td>{{ $pt->points }}</td>
    </tr>
    @endforeach
   
  </tbody>
    </table>
    <br>
    <a href="{{ route('afficherListeEtapes') }}">Retour</a>
    </div>
        </div>
      </div>
     
    </div>
@stop