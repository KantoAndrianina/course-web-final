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
   @include('includes.front.head')
</head>
<body>
       @include('includes.front.header')

           @yield('content')
   
       @include('includes.front.footer')
</body>
</html>