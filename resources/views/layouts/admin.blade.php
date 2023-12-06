<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Teste AI Solutions</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    {{-- "admin" é um modelo de layout feito em bootstrap 4 (opensource) que foi obtido na web e encaixado manualmente neste projeto Laravel 10. O estilo está dispnível em: --}}
    {{-- public/bootstrap, public/css, public/js, public/plugins, public/scss --}}

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>


    {{-- ============================================================== --}}
    {{-- Preloader --}}
    {{-- ============================================================== --}}

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>



    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('plugins/images/logo-icon.png') }}" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('plugins/images/logo-text.png') }}" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex justify-content-end">

                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Vitamina Web Admin') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Administrador do Teste
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background: #414755;">

                                            <style>
                                                a.dropdown-item:hover{
                                                    background: #414755 !important;
                                                }
                                            </style>

                                            <a class="dropdown-item text-center" href="#" style="color: #fff !important;"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="#" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>


                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('fileScreen') }}"
                                aria-expanded="false">
                                <i class="fas fa-file" aria-hidden="true"></i>
                                <span class="hide-menu">Ler arquivo .json</span>
                            </a>
                        </li>

                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('queueScreen') }}"
                                aria-expanded="false">
                                <i class="fas fa-play-circle" aria-hidden="true"></i>
                                <span class="hide-menu">Iniciar fila</span>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>




        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">




            {{-- =========================================================================== --}}
            {{-- Conteúdo das views que utilizam este layout (encaixe)                       --}}
            {{-- =========================================================================== --}}
            <main class="py-4">
                @yield('content')
            </main>


            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">Sistema de Importação</footer>


        </div>

    </div>




    {{-- ============================================================== --}}
    {{-- Jquery --}}
    {{-- ============================================================== --}}
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>


    {{-- ============================================================== --}}
    {{-- Wave Effects --}}
    <script src="{{ asset('js/waves.js') }}"></script>
    {{-- ============================================================== --}}

    {{-- ============================================================== --}}
    {{-- Menu sidebar --}}
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    {{-- ============================================================== --}}

    {{-- ============================================================== --}}
    {{-- Custom JavaScript --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- ============================================================== --}}


    @stack('js-scripts')

</body>
</html>