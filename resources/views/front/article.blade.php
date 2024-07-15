<?php 
$url = config('app.url');
?>
@extends('layouts.app_accueil')

@section('titre', 'UTR - '.$post->titre)
@section('meta_description', Str::limit($post->description, 150))

@section('content')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light text-black">
                                <h1 class="card-title">{{ $post->titre }}</h1>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! $post->description !!}</p>
                            </div>
                        </div>
                        <br>
                        <a href="{{ route('accueil') }}">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection