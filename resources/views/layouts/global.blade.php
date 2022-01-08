<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title') | STOCK | KASIR PINTAR INTERNASIONAL</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- Font Awesome JS -->
    <script src="{{ asset('js/solid.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>

</head>
<style>
    .scrl {
        width: 200px;
        height: 100px;
        overflow-y: scroll; /* Add the ability to scroll */
    }

    .scrl::-webkit-scrollbar-button {
        display: none;
    }

    .scrl {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .btn{
        border-radius: 10px;
    }
    </style>
<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="list-group">
            <div class="sidebar-header" id="sidebarCollapse">
                <strong><i class="fas fa-list"></i></strong>
                <div class="text-center">
                    <span class="float-right btn btn-info ml-3"><i class="fas fa-arrow-left"></i></span>
                    <img src="{{ asset('asset/logo.png')}}" alt="Kementrian Agama" width="80" height="150" class="mb-3">
                </div>
                <h5>STOCK | KASIR PINTAR INTERNASIONAL</h5>
            </div>
            
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ route('barang.index') }}">Barang</a>
                        </li>
                        <li>
                            <a href="{{ route('barang.create') }}">Tambah Barang</a>
                        </li>
                        <li>
                            <a href="">Log Barang</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-user-cog"></i>
                        Account Setting
                    </a>
                    <a href="">
                        <i class="fas fa-briefcase"></i>
                        Portofolio
                    </a>
                </li>
                <li>
                    <a href="http://adinugroho16.000webhostapp.com/">
                        <i class="fas fa-paper-plane"></i>
                        Contact
                    </a>
                </li>
                @auth('user')
                    <li>
                        <a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('user.todoLogin') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="scrl">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="nav navbar-nav mr-auto">
                            <div class="nav-item">
                                <img src="https://kasirpintar.co.id/landing_page/img/logo_kasirpintar.webp" alt="Kementrian Agama" height="40px">
                                <div class="navbar-brand ml-3">
                                    <h4 class="mr-4">STOCK | KASIR PINTAR INTERNASIONAL</h4>
                                </div>
                            </div>
                        </div>
                        <div class="nav navbar-nav ml-auto">
                            <div class="navbar-brand">
                                @auth('user')
                                    {{Auth::guard('user')->user()->name}}
                                @else
                                    Guest
                                @endauth
                            </div>
                        </div>
                    </div>
                    
                </div>
            </nav>
            <div class="pl-3 pr-3">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Popper.JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>