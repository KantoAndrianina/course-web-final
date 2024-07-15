<?php 
$url = config('app.url');
?>
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo $url ?>/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="<?php echo $url ?>/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>