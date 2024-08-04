<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>User Dashboard</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Light Gallery Plugin Css -->
    <link rel="stylesheet" href="{{ url('assets/plugins/light-gallery/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/charts-c3/plugin.css') }}" />

    <link rel="stylesheet" href="{{ url('assets/plugins/morrisjs/morris.min.css') }}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ url('assets/css/style.min.css') }}">
</head>

<body class="theme-blush">
    <!-- Right Icon menu Sidebar -->
    <div class="navbar-right">
        <ul class="navbar-nav">
            <li><a href="javascript:void(0);" title="Light Mode">
                    <div class="light_dark" style="top: -18px; left: 2px; position: relative;">
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="lighttheme" checked="true" value="light">
                            <label for="lighttheme"></label>
                        </div>
                    </div>
                </a></li>

            <li><a href="javascript:void(0);" title="Dark Mode">
                    <div class="light_dark" style="top: -18px; left: 2px; position: relative;">
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark">
                            <label for="darktheme"></label>
                        </div>
                    </div>
                </a></li>

            <li><a href="sign-in.html" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a></li>
        </ul>
    </div>

    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
            <a href="index.html"><img src="assets/images/logo.svg" width="25" alt="Hidden Fact"><span
                    class="m-l-10">Hidden Fact</span></a>
        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg"
                                alt="User"></a>
                        <div class="detail">
                            <h4>Michael</h4>
                            <small>Super Admin</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-accounts"></i><span>Users</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-view-dashboard"></i><span>Classes</span></a>
                </li>
                <li class="open"><a href="index.html"><i
                            class="zmdi zmdi-collection-bookmark"></i><span>Subjects</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-collection-pdf"></i><span>Books</span></a>
                </li>
                <li class="open"><a href="index.html"><i
                            class="zmdi zmdi-time-restore"></i><span>Transactions</span></a>
                </li>
            </ul>
        </div>
    </aside>

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ url('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="{{ url('assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ url('assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ url('assets/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ url('assets/bundles/c3.bundle.js') }}"></script>

    <script src="{{ url('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ url('assets/js/pages/index.js') }}"></script>

    {{-- page specific library --}}
    <script src="{{ url('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="{{ url('assets/plugins/light-gallery/js/lightgallery-all.min.js') }}"></script> <!-- Light Gallery Plugin Js -->
    <script src="{{ url('assets/bundles/fullcalendarscripts.bundle.js') }}"></script><!--/ calender javascripts -->
    <script src="{{ url('assets/js/pages/medias/image-gallery.js') }}"></script>
    <script src="{{ url('assets/js/pages/calendar/calendar.js') }}"></script>
</body>


</html>
