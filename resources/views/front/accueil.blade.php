<?php 
$url = config('app.url');
?>
@extends('layouts.app_accueil')

@section('titre', 'UTR - Tous les Articles')
@section('meta_description', 'Liste de tous les articles sur notre site.')

@section('content')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-md-12">
                @if(count($posts) > 0)
                <h1>Tous les articles</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($posts as $post)
                    <div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title"><a href="{{ route('article.show', ['slug' => $post->slug]) }}">{{ $post->titre }}</a></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! $post->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
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