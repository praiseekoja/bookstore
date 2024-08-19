<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Shop</title>
    <meta name="description" content>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/icon/favicon.png') }}">

    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/price_rangs.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/iziToast.min.css') }}">
</head>

<body>

    @yield('content')

    <script src="{{ url('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ url('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/js/slick.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slicknav.min.js') }}"></script>

    <script src="{{ url('assets/js/wow.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ url('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ url('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ url('assets/js/price_rangs.js') }}"></script>

    <script src="{{ url('assets/js/contact.js') }}"></script>
    <script src="{{ url('assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/js/mail-script.js') }}"></script>
    <script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <script src="{{ url('assets/js/plugins.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    <script src="{{ url('assets/js/blockUI.js') }}"></script>
    <script src="{{ url('assets/js/iziToast.min.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
</body>

</html>
