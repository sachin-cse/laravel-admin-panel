<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/now-ui-dashboard.css?v=1.0.1')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />

    {{-- data tables --}}
    <link href="{{asset('assets/css/dataTables.min.css')}}" rel="stylesheet" />


   <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toastr.min.css')}}">

    @csrf


</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    SM
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Admin dashboard
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="@yield('dashboard')">
                        <a href="{{url('/dashboard')}}">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    {{-- <li class="@yield('Banner')">
                        <a href="{{route('admin.services.banner')}}">
                            <i class="now-ui-icons education_atom"></i>
                            <p>Icons</p>
                        </a>
                    </li> --}}
                    <li class="@yield('Services')">
                        <a href="{{route('admin.services')}}">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Services - Category</p>
                        </a>
                    </li>
                    <li class="@yield('Aboutus')">
                        <a href="{{route('aboutus.view')}}">
                            <i class="now-ui-icons ui-1_bell-53"></i>
                            <p>About us</p>
                        </a>
                    </li>
                    <li class="@yield('Register Roles')">
                        <a href="{{route('users.roles')}}">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>User Profile</p>
                        </a>
                    </li>

                    <li class="@yield('Banner')">
                        <a href="{{route('admin.services.banner')}}">
                            <i class="far fa-images users_single-02"></i>
                            <p>Banner Image</p>
                        </a>
                    </li>

                    
                    <li class="@yield('Communication')">
                        <a href="{{route('admin.serivices.communication')}}">
                            <i class="far fa-comment users_single-02"></i>
                            <p>Communicaion</p>
                        </a>
                    </li>


                    <li class="@yield('ActivityLog')">
                        <a href="{{route('admin.activity.log')}}">
                            <i class="fas fa-history users_single-02"></i>
                            <p>Activity log</p>
                        </a>
                    </li>

                    <li class="@yield('Testimonial')">
                        <a href="{{route('admin.testimonial')}}">
                            <i class="far fa-images users_single-02"></i>
                            <p>Testimonial</p>
                        </a>
                    </li>
                    {{-- <li class="">
                        <a href="../examples/tables.html">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li>
                        <a href="../examples/typography.html">
                            <i class="now-ui-icons text_caps-small"></i>
                            <p>Typography</p>
                        </a>
                    </li> --}}
                    {{-- <li class="active-pro">
                        <a href="../examples/upgrade.html">
                            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Table List</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">

                        {{-- @if(Auth::check() && Route::is('users.roles')) --}}
                        <form method="GET" action="{{route('search')}}" autocomplete="off">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" id="autoSearch" name = "q" placeholder="Search...">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </span>
                            </div>
                            <ul id="searchResults" class="results-list"></ul>
                        </form>

                        {{-- @endif --}}
                       
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a> --}}
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <p class="location_world">Hi, {{ auth()->user()->name }}</p>
                                    {{-- <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p> --}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    {{-- <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a> --}}
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>

            <div class="content">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com">
                                    Creative Tim
                                </a>
                            </li>
                            <li>
                                <a href="http://presentation.creative-tim.com">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Designed by
                        <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/now-ui-dashboard.js?v=1.0.1')}}"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/CkEditor.js')}}"></script>

@yield('scripts')

</html>
