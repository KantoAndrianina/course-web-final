<?php
use Illuminate\Support\Facades\Session;

$url = config('app.url');
$equipe_id=Session::get('equipe_id');
?>

@extends('layouts.app_front')
@section('content')
    <div class="container">
        <form action="{{ route('insertCoureur.front')}}">
        <h2>{{ $etapes[0]->nom }}</h2>
        <input type="hidden" id="id_etapes" name="id_etapes" value="{{ $etapes[0]->id }}">
        Num <select name="id_coureurs" id="id_coureurs">
  @foreach ($coureurs as $pt)
            <option value=" {{ $pt->id }}">{{ $pt->nom }}</option>
    @endforeach
          
        </select><br><br>
        <div>
        @error('error')
            <div class="alert alert-danger">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        <button type="submit" class="btn btn-success">Valider</button>
        </div>
        </form>
    </div>

@stop