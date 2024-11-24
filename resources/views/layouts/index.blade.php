<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(to right, #5d6d7e, #85929e);">

                 <div class="container-fluid px-5">
                <a class="navbar-brand" href="{{ route('index') }}">Clinica del Higado</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item {{ Route::currentRouteName() == 'index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('index') }}">
                                <i class="bi bi-house-fill"></i>
                            </a>
                        </li> -->
                     
                        <li class="nav-item {{ Route::currentRouteName() == 'planes' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('citas.index') }}">Reservas de Citas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="true">Recursos</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                                <li><a class="dropdown-item" href="{{ route('historial.index') }}">Historial</a></li>
                                <li><a class="dropdown-item" href="{{ route('recomendacion.index') }}">Recomendaciones</a></li>
                          
                            </ul>
                        </li>
                      <!--  <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                        </li>-->
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        @if (auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.destroy') }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item {{ Route::currentRouteName() == 'register.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('register.index') }}">Registro</a>
                            </li>
                            <li class="nav-item {{ Route::currentRouteName() == 'login.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login.index') }}">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        @yield('content')


    </main>
    <!-- Footer-->
    <footer>
    @section('footer')
        <div class="py-4 mt-auto" style="background: linear-gradient(to right, #5d6d7e, #85929e);">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <!-- Left Section: Copyright -->
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="small m-0 text-white">Surbug &copy; Proyecto SW2-2024</div>
                    </div>
 
                    <!-- Right Section: Social Media Links -->
                    <div class="col-auto">
                        <a class="link-light small mx-2 text-decoration-none" href="https://www.facebook.com" target="_blank">
                            <i class="bi bi-facebook fs-4"></i> 
                        </a>
                        <a class="link-light small mx-2 text-decoration-none" href="https://wa.me" target="_blank">
                            <i class="bi bi-whatsapp fs-4"></i>
                        </a>
                        <a class="link-light small mx-2 text-decoration-none" href="https://www.tiktok.com" target="_blank">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a class="link-light small mx-2 text-decoration-none" href="https://www.instagram.com" target="_blank">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @show
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
