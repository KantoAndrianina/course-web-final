<?php 
$url = config('app.url');
?>
@extends('layouts.app_accueil')

@section('titre', 'UTR - Créer un article')
@section('meta_description', 'Créer un article')

@section('content')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="text-center">Créer votre article</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('editor.store') }}" method="post">
                            @csrf
                            <div class="mt-3">
                                <label for="titre">Titre de l'article :</label>
                                <input type="text" name="titre" class="form-control" placeholder="Enter Your Title" id="titre">
                            </div>
                            <div class="mt-3">
                                <label for="description">Description :</label> <!-- Correction ici -->
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description"></textarea>
                                @error('description') <!-- Affichage de l'erreur de validation -->
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $url ?>/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/froala_editor.pkgd.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var editor = new FroalaEditor('#description'

            );
        });
    </script>

@stop