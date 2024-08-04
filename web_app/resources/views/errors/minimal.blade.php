<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>@yield('title')</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/style.min.css')}}">
</head>

<body class="theme-blush">


    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form">
                        <div class="header">
                            <img class="logo" src="{{ url('assets/img/logo.svg')}}" alt="">
                            <h5>@yield('code')</h5>
                            <span>@yield('message')</span>
                        </div>
                        <div class="body">
                            {{-- <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-search"></i></span>
                                </div>
                            </div> --}}
                            <a href="{{ route('home') }}" class="btn btn-primary btn-block waves-effect waves-light">GO TO HOMEPAGE</a>
                            {{-- <div class="signin_with mt-3">
                                <a href="javascript:void(0);" class="link">Need Help?</a>
                            </div> --}}
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>document.write(new Date().getFullYear())</script>,
                        <span><a href="{{ route('home') }}">Hidden Facts</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="{{ url('assets/img/maintanance.svg')}}" alt="ERROR" />
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Jquery Core Js -->
        <script src="{{ url('assets/bundles/libscripts.bundle.js')}}"></script>
        <script src="{{ url('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
        </body>

        </html>
