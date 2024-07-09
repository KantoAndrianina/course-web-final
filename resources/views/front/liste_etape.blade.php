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
      <th scope="col">Lieu</th>
      <th scope="col">Coureur</th>

    </tr>
  </thead>
  <tbody>
  @foreach ($etapes as $pt)

    <tr>
      <td>{{ $pt->nom }}</td>
      <td><a class="btn btn-primary" href="{{ route('formCoureur.front',[ 'id'=>$pt->id ]) }}">coureur</a></td>
    </tr>
    @endforeach
   
  </tbody>
    </table>
    </div>

@stop