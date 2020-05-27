<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Log</title>
    <!-- Bootstrap core CSS -->
    <link href = {{ asset("bootstrap/css/bootstrap.css") }} rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href = {{ asset("bootstrap/css/sticky-footer-navbar.css") }} rel="stylesheet" />


    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></head>
<body>
<div class="container">
    @yield('main')
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@yield('js')
</body>
</html>
