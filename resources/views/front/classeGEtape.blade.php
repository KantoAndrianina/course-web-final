<?php
use Illuminate\Support\Facades\Session;

$url = config('app.url');
$equipe_id=Session::get('equipe_id');
?>

@extends('layouts.app_front')
@section('content')
    <div class="container">
    <table class="table table-striped table-hover">
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
    </div>

@stop