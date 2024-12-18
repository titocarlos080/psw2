<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>@yield('title') -Diagnostico IA</title>
    
        <!-- Custom fonts for this template-->
        <link href="{{asset('bsadmin/vendor/fontawesome-free/css/all.min.css  ')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
       <!-- Conditional styles for this template -->
    <link href="{{ asset('bsadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
           <!-- Custom styles for this page -->
        <link href="{{asset('bsadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Tailwind CSS Link -->
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a23e6feb03.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    </head>
    
    <body id="page-top">
    
        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                   
                    <div class="sidebar-brand-text mx-3">Clinica del Higado</div>
                </a>
               
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
    
                <!-- Nav Item - Dashboard -->
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="{{route('admin.index')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>INICIO</span></a>
                </li> -->
                @auth
    <!-- Divider -->
    <hr class="sidebar-divider">
 

    <!-- Nav Item - Pages Collapse Menu -->

    @if (Auth::user()->role == "admin")
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-users"></i> <!-- Users icon -->
                        <span>USUARIO</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role == "admin")
                <a class="collapse-item" href="{{ route('admin.registrarusuario') }}">Usuarios</a>
                <a class="collapse-item" href="{{ route('admin.listarMedico') }}">Medico</a>
                <a class="collapse-item" href="{{ route('admin.listarcliente') }}">Clientes</a>
        
                @endif
            
            </div>
        </div>
    </li>
    @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne3"
            aria-expanded="true" aria-controls="collapseOne3">
            <i class="fas fa-fw fa-calendar-check"></i> <!-- Calendar icon for availability -->
                        <span>Disponibilidad</span>
        </a>
        <div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role == "medico")
                <a class="collapse-item" href="{{ route('disponibilidades.index') }}">Disponibilidad</a>
                @endif
            
            </div>
        </div>
    </li>

    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne2"
        aria-expanded="true" aria-controls="collapseOne2">
        <i class="fas fa-fw fa-cog"></i>
        <span>Opciones</span>
    </a>



    <div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            @if (Auth::user()->role == "admin")
                <a class="collapse-item d-flex align-items-center" href="{{ route('disponibilidades.index') }}">
                    <i class="fas fa-calendar-check fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span class="text-nowrap">Disponibilidad</span>
                </a>
                <a class="collapse-item d-flex align-items-center" href="{{ route('citas.recepciones') }}">
                    <i class="fas fa-calendar-day fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span class="text-nowrap">Recepcion</span>
                </a>

                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Diagnósticos:</h6>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('diagnosticos.create') }}">
                        <i class="fas fa-stethoscope fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Crear Diagnóstico</span>
                    </a>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('diagnosticos.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Diagnósticos</span>
                    </a>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('diagnosticos.createsolicitud') }}">
                        <i class="fas fa-file-medical-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Solicitar Diagnóstico API</span>
                    </a>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('planes') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Planes</span>
                    </a>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('service') }}">
                        <i class="fas fa-concierge-bell fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Service</span>
                    </a>
                    <a class="collapse-item d-flex align-items-center" href="{{ route('recomendacion.create') }}">
                        <i class="fas fa-hand-holding-medical fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span class="text-nowrap">Solicitudes</span>
                    </a>
                </div>

               

            @endif

            @if (Auth::user()->role == "medico")
                <a class="collapse-item d-flex align-items-center" href="{{ route('diagnosticos.create') }}">
                    <i class="fas fa-stethoscope fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span class="text-nowrap">Crear Diagnóstico</span>
                </a>
                <a class="collapse-item d-flex align-items-center" href="{{ route('recomendacion.create') }}">
                    <i class="fas fa-hand-holding-medical fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span class="text-nowrap">Solicitudes</span>
                </a>
                <a class="collapse-item d-flex align-items-center" href="{{ route('servicemedic') }}">
                    <i class="fas fa-user-md fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span class="text-nowrap">Servicio de Reconocimiento</span>
                </a>
            @endif
        </div>
    </div>

    @if (Auth::user()->role == "admin")

     <a class="nav-link collapsed"  href="{{ route('admin.backup') }}"  
         aria-controls="collapseOne2">
        <i class="fas fa-hdd fa-cog"></i>
        <span>Backup</span>
    </a>
    @endif

</li>

@endauth

    
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
    
                 
                 
    
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light custom-navbar topbar mb-4 static-top shadow">    
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                     
                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search" name="search"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
    
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
    
                        @guest
                          <li class="nav-item">
                                  <a class="nav-link" href="{{ route('login.index') }}">{{ __('Login') }}</a>
                          </li>
                          <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register.index') }}">{{ __('Registrar') }}</a>
                          </li>
                        
                        @else
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
    
                       
    
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link" href="#" id="themeSwitch" role="button" onclick="switchTheme()">
                                    <i class="fas fa-moon fa-sm fa-fw mr-2 text-gray-400"></i> 
                                    <!-- Icono para representar el cambio de tema -->
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                </a>
                            </li>
                          <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">

 
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="img-profile rounded-circle" src="{{asset('bsadmin/undraw_profile.svg')}}" alt="User Avatar">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <!-- Nombre del usuario con un enlace de perfil -->
                                      <a class="dropdown-item" href="#">
                                          <b>{{ auth()->user()->name }}</b>
                                       </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Membership
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                          @endguest
                        </ul>
    
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->

<!-- ########################################################################################## -->


  @yield('content')

<!-- AQUI TERMINA LAS OPCIONES ANTEIROESSSSSSSSSSSS########################################################################################## -->
    
                
                    </div>
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->
    
              
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{route('login.destroy')}}" >Logout</a>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('bsadmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('bsadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
        <script src="{{asset('bsadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <script src="{{asset('bsadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('bsadmin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    
        <!-- Page level custom scripts -->
        <script src="{{asset('bsadmin/js/demo/datatables-demo.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('bsadmin/js/sb-admin-2.min.js')}}"></script>
    
           <!-- Scripts -->
    <script>
        function switchTheme() {
            const themeSwitcher = document.getElementById('theme-switcher');
            const theme = themeSwitcher.value;
            fetch('/change-theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: theme })
            }).then(() => {
                location.reload();
            });
        }
    </script>
    
    </body>
    
    </html>


<!-- TERMINA EL DHASBOARDDDDDDDDDDDDD########################################################################################## -->

