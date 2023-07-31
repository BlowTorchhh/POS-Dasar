<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - Latihan</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('style/images/pentagon-half.svg') }}">

    <link rel="stylesheet" href="{{ asset('style/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('style/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('style/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('style/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('style/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{ asset('style/vendors/jqvmap/dist/jqvmap.min.css')}}">
    @yield('head')

    <link rel="stylesheet" href="{{ asset('style/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

    <script src="{{ asset('style/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('style/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('style/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('style/assets/js/main.js')}}"></script>

    <script src="{{ asset('style/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('style/assets/js/dashboard.js')}}"></script>
    <script src="{{ asset('style/assets/js/widgets.js')}}"></script>
    <script src="{{ asset('style/vendors/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('style/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{ asset('style/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel" style="background-color: cornflowerBlue;">
        <nav class="navbar navbar-expand-sm navbar-default" style="background-color: cornflowerBlue;">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa fa-tasks " style="color: white;"></i>
                </button>
                @if (auth()->user()->level == "1")
                <a class="navbar-brand" href="{{ url('admin')}}">POS Sederhana</a>
                @endif
                @if (auth()->user()->level == "2")
                <a class="navbar-brand" href="{{ url('user')}}">POS Sederhana</a>
                @endif
                <a class="navbar-brand hidden" href=""><i class="menu-icon fa fa-home"></i></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" style="color: white;">
                    @if (auth()->user()->level == "1")
                    <li class="active">
                        <a href="{{ url('admin')}}"> <i class="menu-icon fa fa-dashboard" style="color: black;"></i>Dashboard </a>
                    </li>
                    @endif
                    @if (auth()->user()->level == "2")
                    <li class="active">
                        <a href="{{ url('user')}}"> <i class="menu-icon fa fa-dashboard" style="color: black;"></i>Dashboard </a>
                    </li>
                    @endif
                    @if (auth()->user()->level == "1")
                    <li class="active">
                        <a href="{{('/kategori/kategori')}}"> <i class="menu-icon fa fa-tasks" style="color: black;"></i>Kategori </a>
                    </li>
                    <li class="active">
                        <a href="{{('/produk/produk')}}"> <i class="menu-icon fa fa-truck" style="color: black;"></i>Product </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('Barang-masuk/Barang-masuk')}}"> <i class="menu-icon fa fa-money" style="color: black;"></i>Barang Masuk</a>
                    </li>
                    <li class="active">
                        <a href="{{ url('pengeluaran')}}"> <i class="menu-icon fa fa-shopping-cart" style="color: black;"></i>Pengeluaran </a>
                    </li>
                    @endif
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file" style="color: white;"></i>Rekap Laporan</a>
                        <ul class="sub-menu children dropdown-menu" style="background: cornflowerBlue">
                            <li><i class="fa fa-file"></i><a href="{{ url('laporan-produk') }}">Rekap Product</a></li>
                            <li><i class="fa fa-file"></i><a href="{{ url('laporan-barang-masuk') }}">Rekap Laporan Barang Masuk</a></li>
                            <li><i class="fa fa-file"></i><a href="{{ url( 'laporan-pengeluaran' ) }}">Rekap Laporan Pengeluaran</a></li>
                        </ul>
                    </li>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
            @if (auth()->user()->level == "1")
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" style="color: white;">
                    <li>
                        <a href="{{ url('users') }}"> <i class="menu-icon fa fa-user" style="color: white;"></i>Users</a>
                    </li>
                </ul>
            </div>
            @endif
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left" style="background: darkblue;"><i class="fa fa fa-hand-o-left"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (auth()->user()->level == "1")
                                <img class="user-avatar rounded-circle" src="{{ asset('style/images/admin.jpg') }}" alt="User Avatar">
                            @endif
                            @if (auth()->user()->level == "2")
                                <img class="user-avatar rounded-circle" src="{{ asset('style/images/guest.png') }}" alt="User Avatar">
                            @endif
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('password') }}"><i class="fa fa-user"></i> Profil</a>

                            <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                   

                </div>
            </div>

        </header>
        <!-- Header-->

        @yield('breadcrumbs')

        @yield('content')

    


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    

</body>

</html>
