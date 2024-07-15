<?php 
$url = config('app.url');
?>
<!doctype html>
<html>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6RRXFGB5YT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6RRXFGB5YT');
    </script>
    <meta charset= "utf-8" >
    <title>@yield('titre', 'Mon Application Laravel')</title>
    <meta name="description" content="@yield('meta_description', 'Description par défaut de l\'application')">
    <link rel="stylesheet" href="<?php echo $url ?>/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/froala_editor.pkgd.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('accueil') }}">Ultimate Team Race</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'accueil' ? 'active' : '' }}" href="{{ route('accueil') }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'creer.article' ? 'active' : '' }}" href="{{ route('creer.article') }}">Créer un article</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="{{ route('login.equipe') }}">Login Équipe</a>
                </li>
            </ul>
            </div>

        </div>
    </nav>
    @yield('content')
</body>
</html>