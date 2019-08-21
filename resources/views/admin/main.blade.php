<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Admin</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('libraries/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('libraries/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('libraries/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/customPortfolio.css') }}">
      <link rel="stylesheet" href="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.css') }}">
    @stack('styles')
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="index.html">Admin Panel</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <div class="d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </div>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span class="badge badge-danger"> {{ $new_message }} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
{{--        @php dd($nav_bar) @endphp--}}
        <ul class="sidebar navbar-nav">
            <li class="nav-item {{ ($nav_bar == 'Dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ ($nav_bar == 'Team members') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.team_members') }}">
                    <i class="fas fa-users"></i>
                    <span>Team members</span>
                </a>
            </li>
            <li class="nav-item {{ ($nav_bar == 'Projects') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.projects') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Projects</span>
                </a>
            </li>
            <li class="nav-item {{ ($nav_bar == 'Services') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.services') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="nav-item {{ ($nav_bar == 'About') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.about') }}">
                    <i class="fas fa-id-card"></i>
                    <span>About</span>
                </a>
            </li>
            <li class="nav-item {{ ($nav_bar == 'Feedback') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.feedback') }}">
                    <i class="fas fa-address-book"></i>
                    <span>Feedback</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    @if ($nav_bar != 'Dashboard')
                    <li class="breadcrumb-item active">{{ $active_page }}</li>
                    @endif
                </ol>

                @yield('content')
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © The Expendables 2018</span>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('libraries/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('libraries/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('libraries/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('libraries/datatables/dataTables.bootstrap4.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <script src="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    @stack('scripts')

  </body>

</html>
