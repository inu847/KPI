<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Penjurusan | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/app.js')}}">
    <link rel="stylesheet" href="{{ asset('favicon.ico')}}">
</head>
<style>
    .input-group{
        margin-bottom: 10px;
    }

    .container .card-center {
        margin: 0 auto;
    }

    @media (max-width: 670px) {
    .flex-list {
        flex-direction: column;
    }
    .flex-list li {
        margin: 0 auto;
    }
    .navbar-brand h4{
        font-size: 0.50rem;
    }
    .navbar-brand img{
        width: 30px;
        height: 30px;
    }
    .navbar-brand {
        display: inline-block;
        padding-top: 0.10rem;
        padding-bottom: 0.10rem;
        margin-right: 0.5rem;
        font-size: 0.35rem;
        line-height: inherit;
        white-space: nowrap;
    }
    .navbar-brand:hover, .navbar-brand:focus {
        text-decoration: none;
    }
    .table {
        width: 30%;
        margin-bottom: 1rem;
        color: #212529;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #dee2e6;
    }
    .table tbody + tbody {
        border-top: 1px solid #dee2e6;
    }
}
</style>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="https://kasirpintar.co.id/landing_page/img/logo_kasirpintar.webp" height="44px">
          </a>
          <div class="navbar-brand" href="">STOCK | KASIR PINTAR INTERNASIONAL</div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="text-center">
        <div class="footer-content">
            <div class="container-fluid">
                <p class="mt-5 mb-3 text-muted">&copy; STOCK | KASIR PINTAR INTERNASIONAL </p>
            </div>
        </div>
    </footer>
</body>
</html>