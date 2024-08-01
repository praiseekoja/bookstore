<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>User Dashboard</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css" />

    <link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.min.css">
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
            <a href="index.html"><img src="assets/images/logo.svg" width="25" alt="Aero"><span
                    class="m-l-10">Aero</span></a>
        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg"
                                alt="User"></a>
                        <div class="detail">
                            <h4>Michael</h4>
                            <small>User</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-folder"></i><span>Collections</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-user"></i><span>Profile</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-sale"></i><span>Transactions</span></a>
                </li>
                <li class="open"><a href="index.html"><i class="zmdi zmdi-sale"></i><span>Saved Items</span></a>
                </li>
            </ul>
        </div>
    </aside>

    @yield('content')


    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
    <script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
    <script src="assets/bundles/c3.bundle.js"></script>

    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="assets/js/pages/index.js"></script>
</body>


</html>
