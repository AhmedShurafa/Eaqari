<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <link rel="stylesheet" href="{{asset("assets/css/all.css")}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset("assets/dashboard/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("assets/dashboard/css/sb-admin-2.min.css")}}" rel="stylesheet">

    <link href="{{asset("js/noty/noty.css")}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("assets/css/lightbox.min.css")}}">

    <link rel="stylesheet" href="{{asset("css/app.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/style_ar.css")}}">

    @stack('style')

    <style>
        .table-responsive{
            overflow-x: hidden !important;
        }
        .noty_body{
            background-color: #36b9cc;
            color: #fff;
        }
    </style>
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.blade.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        @if(Auth::user()->role == 1)
            <li class="nav-item {{Request::is('dashboard/admin*') ? 'active' : null }}">
                <a class="nav-link" href="{{route("dashboard.index")}}">
                    <i class="fas fa-fw fa-tachometer-alt" style="font-size: 20px"></i>
                    <span style="font-size: 20px">الصفحة الرئيسية</span>
                </a>
            </li>

            <!-- السماسرة -->
            <li class="nav-item {{Request::is('dashboard/users*') ? 'active' : null }}">
                <a class="nav-link" href="{{route("dashboard.users.index")}}">
                    <i class="fas fa-user-alt" style="font-size: 20px"></i>
                    <span style="font-size: 20px">المستثمرين</span>
                </a>
            </li>
            <!-- المنشأت -->
            <li class="nav-item {{Request::is('dashboard/apartment*') ? 'active' : null }}">
                <a class="nav-link" href="{{route("dashboard.apartment.index")}}">
                    <i class="fas fa-user-alt" style="font-size: 20px"></i>
                    <span style="font-size: 20px">المنشأت</span>
                </a>
            </li>
            <li class="nav-item {{Request::is('message*') ? 'active' : null }}">
            <a class="nav-link" href="{{route("message.index")}}">
                    <i class="fas fa-envelope" style="font-size: 20px"></i>
                    <span style="font-size: 20px">الرسائل</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">--}}
{{--                    <i class="fas fa-fw fa-cog"></i>--}}
{{--                    <span>المنشأت</span>--}}
{{--                </a>--}}
{{--                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">--}}
{{--                    <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                        <h6 class="collapse-header">Custom Components:</h6>--}}
{{--                        <a class="collapse-item" href="buttons.html">Buttons</a>-user.status-}}
{{--                        <a class="collapse-item" href="cards.html">Cards</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
            @else
            <li class="nav-item {{Request::is('dashboard/show/apartment*') ? 'active' : null }}">
                <a class="nav-link" href="{{route("dashboard.owner")}}">
                    <i class="fas fa-user-alt" style="font-size: 20px"></i>
                    <span style="font-size: 20px">منشئاتي</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route("message.index")}}">
                    <i class="fas fa-envelope" style="font-size: 20px"></i>
                    <span style="font-size: 20px">الرسائل</span>
                </a>
            </li>
        @endif
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('dashboard.users.update', Auth::id())}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
{{--                            <a class="dropdown-item" href="#">--}}
{{--                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                                Settings--}}
{{--                            </a>--}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

        @yield('content')


        <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{asset("assets/dashboard/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset("assets/dashboard/vendor/jquery-easing/jquery.easing.min.js")}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset("assets/dashboard/js/sb-admin-2.min.js")}}"></script>

<!-- Page level plugins -->
<script src="{{asset("assets/dashboard/vendor/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>

<script src="{{asset("js/noty/noty.min.js")}}"></script>

<script src="{{asset("assets/js/lightbox.min.js")}}"></script>


<!-- Page level custom scripts -->
<script src="{{asset("assets/dashboard/js/demo/datatables-demo.js")}}"></script>

<script>
    @if(session('success'))
        new Noty({
            layout:'topLeft',
            text: '{{session('success')}}',
            timeout:3000,
            killer:true
        }).show();
    @endif
</script>
@stack('script')
</body>

</html>
