<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $book->title }} - Hidden Facts Books</title>
    <meta name="description" content>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/icon/favicon.png') }}">

    <link rel="stylesheet" href="{{ url('assets/css/ccstyle.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/tiny-slider.css') }}">

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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .header-area .header-top .header-info-right .shopping-card::before {
            position: absolute;
            content: "@php echo $cartCount; @endphp";
            width: 24px;
            height: 24px;
            background: #FF1616;
            color: #fff;
            line-height: 24px;
            text-align: center;
            border-radius: 30px;
            font-size: 12px;
            top: -8px;
            right: -8px;
            -webkit-transition: all .3s ease-out 0s;
            -moz-transition: all .3s ease-out 0s;
            -ms-transition: all .3s ease-out 0s;
            -o-transition: all .3s ease-out 0s;
            transition: all .3s ease-out 0s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3)
        }
    </style>
    
    <script src="{{ url('assets/js/vendor/pdf.mjs') }}" type="module"></script>

    <script type="module">
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '{{ url($book->book_file) }}';

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var {
            pdfjsLib
        } = globalThis;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ url('assets/js/vendor/pdf.worker.mjs') }}";

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.8,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
    </script>
</head>

<body>
    <header>
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top ">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="d-flex justify-content-between align-items-center flex-sm">
                                    <div class="header-info-left d-flex align-items-center">

                                        <div class="logo">
                                            <a href="{{ route('home') }}"><img
                                                    src="{{ url('assets/img/logo/logo.png') }}" alt></a>
                                        </div>

                                        <form action="{{ route('search') }}" class="form-box">
                                            <input type="text" name="query" placeholder="Search book by name">
                                            <div class="search-icon">
                                                <i class="ti-search"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="logo2">
                                    <a href="{{ route('home') }}"><img src="{{ url('assets/img/logo/logo.png') }}"
                                            alt></a>
                                </div>
                                    <div class="header-info-right d-flex align-items-center">
                                        <ul>
                                            <li class="shopping-card">
                                                <a href="{{ route('cart') }}"><img
                                                        src="{{ url('assets/img/icon/cart.svg') }}" alt></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.dashboard') }}"><i class="fa fa-user"></i></a>
                                            </li>
                                            
                                            @if (!session()->has('user'))
                                            <li><a href="{{ route('login') }}" class="btn header-btn">Sign in</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12">

                                <div class="main-menu text-center d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('store') }}">Store</a></li>
                                            
                                            @if (count($classes) > 0)
                                                <li><a href="#">Classes</a>
                                                    <ul class="submenu">
                                                        @foreach ($classes as $class)
                                                            <li><a
                                                                    href="{{ route('store.class', $class->id) }}">{{ $class->class_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif

                                            @if (count($subjects) > 0)
                                                <li><a href="#">Subjects</a>
                                                    <ul class="submenu">
                                                        @foreach ($subjects as $subject)
                                                            <li><a
                                                                    href="{{ route('store.subject', $subject->id) }}">{{ $subject->subject_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                            <li><a href="{{ route('video') }}">Videos</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                            <li><a href="{{ route('about') }}">About</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    @yield('content')

    <footer>
        <div class="footer-wrappper section-bg">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">

                                    <div class="footer-logo mb-25">
                                        <a href="{{ route('home') }}"><img
                                                src="{{ url('assets/img/logo/logo2_footer.png') }}" alt></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Otumudia Publishers Limited is a publishing firm. The series 'Hidden facts books' is solely owned and published by the company, Otumudia Publishers Limited.</p>
                                        </div>
                                    </div>

                                    <div class="footer-social">
                                        <a href="https://web.facebook.com/profile.php?id=61561631919045"><i class="fab fa-facebook"></i></a>
                                        <a href="https://www.instagram.com/hiddenfactsbooks/"><i class="fab fa-instagram"></i></a>
                                        <a href="https://wa.me/message/D4YC42X6A6SNF1"><i class="fab fa-whatsapp"></i></a>
                                        <a href="https://x.com/hiddenfactsbook"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.youtube.com/@hiddenfactsbooks"><i class="fab fa-youtube"></i></a>
                                        <a href="https://www.tiktok.com/@hiddenfactsbooks"><i class="fab fa-tiktok"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Classes</h4>
                                    <ul>
                                        @foreach ($classes as $class)
                                            <li><a
                                                    href="{{ route('store.class', $class->id) }}">{{ $class->class_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Subjects</h4>
                                    <ul>
                                        @foreach ($subjects as $subject)
                                            <li><a
                                                    href="{{ route('store.subject', $subject->id) }}">{{ $subject->subject_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Site Map</h4>
                                    <ul class="mb-20">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('store') }}">Store</a></li>
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </footer>

    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>


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

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

</body>

</html>
