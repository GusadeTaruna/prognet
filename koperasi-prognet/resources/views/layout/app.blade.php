<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('images/favicon.png')}}">
    <title>@yield('judul')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ URL::asset('plugins/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ URL::asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" style="background-color: #118334">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ URL::asset('images/users/1.png')}}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{URL::asset('images/users/1.png')}}" alt="user"></div>
                                            <div class="u-text">
                                                <h4> {{ Auth::user()->nama }}</h4>
                                                @if (Auth::user()->user_role==1)
                                                    <p>Pengelola Simpanan</p>
                                                @elseif (Auth::user()->user_role==2)
                                                    <p>Pengelola Pinjaman</p>
                                                @elseif (Auth::user()->user_role==3)
                                                    <p>Administrator</p>
                                                @endif
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </li>
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
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">NAVIGASI</li>
                        @if (Auth::user()->user_role==3)
                         <ul><li><a class=" waves-effect waves-dark" href="/" > Dashboard</a></li></ul>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Master</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/user">Data Karyawan</a></li>
                                    <li><a href="/anggota">Data Anggota</a></li>
                                    <li><a href="/bunga/create">Bunga</a></li>
                                    <li><a href="/jenistransaksi">Jenis Transaksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Transaksi</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/simpanan/create">Simpanan-Penarikan</a></li>
                                    <li><a href="/hitungbunga">Hitung Bunga</a></li>
                                    <li><a href="#">Koreksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Report</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/report_nasabah">Nasabah</a></li>
                                    <li><a href="/report_harian">Hari</a></li>
                                    <li><a href="/report_mingguan">Minggu</a></li>
                                    <li><a href="/report_bulanan">Bulan</a></li>
                                </ul>
                            </li>
                        @elseif (Auth::user()->user_role==2)
                        <ul><li><a class=" waves-effect waves-dark" href="/" > Dashboard</a></li></ul>
                        <li> <a class=" waves-effect waves-dark" href="/"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Master</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/user">Data Karyawan</a></li>
                                    <li><a href="/anggota">Data Anggota</a></li>
                                    <li><a href="/bunga/create">Bunga</a></li>
                                    <li><a href="/jenistransaksi">Jenis Transaksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Transaksi</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/simpanan">Pinjaman</a></li>
                                    <li><a href="/hitungbunga">Hitung Bunga</a></li>
                                    <li><a href="#">Koreksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Report</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Hari</a></li>
                                    <li><a href="#">Minggu</a></li>
                                    <li><a href="#">Bulan</a></li>
                                </ul>
                            </li>
                        @elseif (Auth::user()->user_role==1)
                        <ul><li><a class=" waves-effect waves-dark" href="/" > Dashboard</a></li></ul>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Master</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/user">Data Karyawan</a></li>
                                    <li><a href="/anggota">Data Anggota</a></li>
                                    <li><a href="/bunga/create">Bunga</a></li>
                                    <li><a href="/jenistransaksi">Jenis Transaksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Transaksi</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/simpanan/create">Simpanan-Penarikan</a></li>
                                    <li><a href="/hitungbunga">Hitung Bunga</a></li>
                                    <li><a href="#">Koreksi</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Report</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Hari</a></li>
                                    <li><a href="#">Minggu</a></li>
                                    <li><a href="#">Bulan</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        @yield('content')
        @show

    <script src="{{ URL::asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::asset('plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ URL::asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ URL::asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ URL::asset('plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ URL::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!--morris JavaScript -->
    <script src="{{ URL::asset('plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{ URL::asset('plugins/morrisjs/morris.min.js')}}"></script>
    <script src="{{ URL::asset('swal/sweetalert2.all.min.js')}}"></script>
    <!-- Chart JS -->
    <script src="{{ URL::asset('js/dashboard1.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script src="{{ URL::asset('plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
                     <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
</body>

</html>