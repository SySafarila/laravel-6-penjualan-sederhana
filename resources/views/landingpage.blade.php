<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/fonts/themify/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/lightbox2/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/css/main.css') }}">
</head>

<body class="animsition">

    <!-- Header -->
    <nav class="bg-white fixed-top navbar navbar-expand-md navbar-light shadow-sm shadow1">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Rafly Resto
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}"
                                href="{{ route('products.public.index') }}">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Auth::user()->role->name == 'seller')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}" href="{{ route('products.public.index') }}">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['seller/products']) ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    Products Manager
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['seller/invoices', 'seller/invoices/*']) ? 'active' : '' }}" href="{{ route('seller.invoices.index') }}">
                                    Invoices
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role->name == 'buyer')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}"
                                    href="{{ route('products.public.index') }}">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['invoices', 'invoices/*']) ? 'active' : '' }}"
                                    href="{{ route('invoices.index') }}">
                                    Invoices
                                </a>
                            </li>
                        @endif
                        @component('components.carts')
                        @endcomponent
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- @if (Auth::user()->role->name == 'seller')
                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        Products
                                    </a>
                                    <a class="dropdown-item" href="{{ route('seller.invoices.index') }}">
                                        Invoices
                                    </a>
                                @endif --}}
                                {{-- @if (Auth::user()->role->name == 'buyer')
                                    <a class="dropdown-item" href="{{ route('invoices.index') }}">
                                        Invoices
                                    </a>
                                @endif --}}
                                <a class="dropdown-item" href="{{ route('account.index') }}">
                                    Account
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar trans-0-4">
        <!-- Button Hide sidebar -->
        <button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

        <!-- - -->
        <ul class="menu-sidebar p-t-95 p-b-70">
            <li class="t-center m-b-13">
                <a href="index.html" class="txt19">Home</a>
            </li>
            <li class="t-center m-b-13">
                <a href="#about" class="txt19">About</a>
            </li>
            <li class="t-center m-b-13">
                <a href="#menu" class="txt19">Menu</a>
            </li>



        </ul>

        <!-- - -->
        <div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
            <!-- - -->
            <h4 class="txt20 m-b-33">
                Gallery
            </h4>

            <!-- Gallery -->
            <div class="wrap-gallery-sidebar flex-w">
                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-01.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-01.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-02.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-02.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-03.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-03.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-05.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-05.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-06.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-06.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-07.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-07.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-09.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-09.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-10.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-10.jpg') }}" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w"
                    href="{{ asset('landing-page/images/photo-gallery-11.jpg') }}" data-lightbox="gallery-footer">
                    <img src="{{ asset('landing-page/images/photo-gallery-thumb-11.jpg') }}" alt="GALLERY">
                </a>
            </div>
        </div>
    </aside>

    <!-- Slide1 -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1 item1-slick1"
                    style="background-image: url('{{ asset('landing-page/images/slide1-01.jpg') }}');">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <span class="caption1-slide1 txt1 t-center animated visible-false m-b-15"
                            data-appear="fadeInDown">
                            Welcome to
                        </span>

                        <h2 class="caption2-slide1 tit1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
                            Rafly Resto
                        </h2>

                        <div class="wrap-btn-slide1 animated visible-false" data-appear="zoomIn">
                            <!-- Button1 -->
                            <a href="#menu" class="btn1 flex-c-m size1 txt3 trans-0-4">
                                Look Menu
                            </a>
                        </div>
                    </div>
                </div>

                <div class="item-slick1 item2-slick1"
                    style="background-image: url('{{ asset('landing-page/images/master-slides-02.jpg') }}');">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <span class="caption1-slide1 txt1 t-center animated visible-false m-b-15" data-appear="rollIn">
                            Welcome to
                        </span>

                        <h2 class="caption2-slide1 tit1 t-center animated visible-false m-b-37"
                            data-appear="lightSpeedIn">
                            Rafly Resto
                        </h2>

                        <div class="wrap-btn-slide1 animated visible-false" data-appear="slideInUp">
                            <!-- Button1 -->
                            <a href="#menu" class="btn1 flex-c-m size1 txt3 trans-0-4">
                                Look Menu
                            </a>
                        </div>
                    </div>
                </div>

                <div class="item-slick1 item3-slick1"
                    style="background-image: url('{{ asset('landing-page/images/master-slides-01.jpg') }}');">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <span class="caption1-slide1 txt1 t-center animated visible-false m-b-15"
                            data-appear="rotateInDownLeft">
                            Welcome to
                        </span>

                        <h2 class="caption2-slide1 tit1 t-center animated visible-false m-b-37"
                            data-appear="rotateInUpRight">
                            Rafly Resto
                        </h2>

                        <div class="wrap-btn-slide1 animated visible-false" data-appear="rotateIn">
                            <!-- Button1 -->
                            <a href="#menu" class="btn1 flex-c-m size1 txt3 trans-0-4">
                                Look Menu
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="wrap-slick1-dots"></div>
        </div>
    </section>

    <!-- Welcome -->
    <section class="section-welcome bg1-pattern p-t-120 p-b-105" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-t-45 p-b-30">
                    <div class="wrap-text-welcome t-center">
                        <span class="tit2 t-center">
                            About Our
                        </span>

                        <h3 class="tit3 t-center m-b-35 m-t-5">
                            Restaurant
                        </h3>

                        <p class="t-center m-b-22 size3 m-l-r-auto">
                            Donec quis lorem nulla. Nunc eu odio mi. Morbi nec lobortis est. Sed fringilla, nunc sed
                            imperdiet lacinia, nisl ante egestas mi, ac facilisis ligula sem id neque.
                        </p>

                    </div>
                </div>

                <div class="col-md-6 p-b-30">
                    <div class="wrap-pic-welcome size2 bo-rad-10 hov-img-zoom m-l-r-auto">
                        <img src="{{ asset('landing-page/images/our-story-01.jpg') }}" alt="IMG-OUR">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Intro -->
    <section class="section-intro" id="menu">
        <div class="header-intro parallax100 t-center p-t-135 p-b-158"
            style="background-image: url('{{ asset('landing-page/images/bg-intro-01.jpg') }}');">
            <span class="tit2 p-l-15 p-r-15">
                Discover
            </span>

            <h3 class="tit4 t-center p-l-15 p-r-15 p-t-3">
                Rafly Resto
            </h3>
        </div>

        <div class="content-intro bg-white p-t-77 p-b-133">
            <div class="container">
                <div class="title-section-ourmenu t-center m-b-22">
                    <span class="tit2 t-center">
                        Discover
                    </span>

                    <h3 class="tit5 t-center m-t-2">
                        Our Menu
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 p-t-30">
                        <!-- Block1 -->
                        <div class="blo1">
                            <div class="wrap-pic-blo1 bo-rad-10 hov-img-zoom">
                                <a href="#"><img src="{{ asset('landing-page/images/intro-01.jpg') }}"
                                        alt="IMG-INTRO"></a>
                            </div>

                            <div class="wrap-text-blo1 p-t-35">
                                <a href="#">
                                    <h4 class="txt5 color0-hov trans-0-4 m-b-13">
                                        Romantic Restaurant
                                    </h4>
                                </a>

                                <p class="m-b-20">
                                    Phasellus lorem enim, luctus ut velit eget, con-vallis egestas eros.
                                </p>

                                <a href="#" class="txt4">
                                    Lets Order Now
                                    <i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 p-t-30">
                        <!-- Block1 -->
                        <div class="blo1">
                            <div class="wrap-pic-blo1 bo-rad-10 hov-img-zoom">
                                <a href="#"><img src="{{ asset('landing-page/images/intro-02.jpg') }}"
                                        alt="IMG-INTRO"></a>
                            </div>

                            <div class="wrap-text-blo1 p-t-35">
                                <a href="#">
                                    <h4 class="txt5 color0-hov trans-0-4 m-b-13">
                                        Delicious Food
                                    </h4>
                                </a>

                                <p class="m-b-20">
                                    Aliquam eget aliquam magna, quis posuere risus ac justo ipsum nibh urna
                                </p>

                                <a href="#" class="txt4">
                                    Lets Order Now
                                    <i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 p-t-30">
                        <!-- Block1 -->
                        <div class="blo1">
                            <div class="wrap-pic-blo1 bo-rad-10 hov-img-zoom">
                                <a href="#"><img src="{{ asset('landing-page/images/intro-04.jpg') }}"
                                        alt="IMG-INTRO"></a>
                            </div>

                            <div class="wrap-text-blo1 p-t-35">
                                <a href="#">
                                    <h4 class="txt5 color0-hov trans-0-4 m-b-13">
                                        Red Wines You Love
                                    </h4>
                                </a>

                                <p class="m-b-20">
                                    Sed ornare ligula eget tortor tempor, quis porta tellus dictum.
                                </p>

                                <a href="#" class="txt4">
                                    Lets Order Now
                                    <i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Our menu -->


    <!-- Event -->
    <section class="section-event">
        <div class="wrap-slick2">
            <div class="slick2">
                <div class="item-slick2 item1-slick2"
                    style="background-image: url('{{ asset('landing-page/images/bg-event-01.jpg') }}');">
                    <div class="wrap-content-slide2 p-t-115 p-b-208">
                        <div class="container">
                            <!-- - -->
                            <div class="title-event t-center m-b-52">
                                <span class="tit2 p-l-15 p-r-15">
                                    Lets Order
                                </span>

                                <h3 class="tit6 t-center p-l-15 p-r-15 p-t-3">
                                    The Food Now
                                </h3>
                            </div>

                            <!-- Block2 -->
                            <div class="blo2 flex-w flex-str flex-col-c-m-lg animated visible-false"
                                data-appear="zoomIn">
                                <!-- Pic block2 -->
                                <a href="#" class="wrap-pic-blo2 bg1-blo2"
                                    style="background-image: url('{{ asset('landing-page/images/event-02.jpg') }}');">

                                </a>

                                <!-- Text block2 -->
                                <div class="wrap-text-blo2 flex-col-c-m p-l-40 p-r-40 p-t-45 p-b-30">
                                    <h4 class="tit7 t-center m-b-10">
                                        Don't make yourself waiting
                                    </h4>



                                    <a href="{{ route('products.public.index') }}" class="txt4 m-t-40">
                                        Start the order now
                                        <i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="wrap-slick2-dots"></div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="bg1">
        <div class="container p-t-40 p-b-70">
            <div class="row">
                <div class="col-sm-6 col-md-8 p-t-50">
                    <!-- - -->
                    <h4 class="txt13 m-b-33">
                        Contact Us
                    </h4>

                    <ul class="m-b-70">
                        <li class="txt14 m-b-14">
                            <i class="fa fa-map-marker fs-16 dis-inline-block size19" aria-hidden="true"></i>
                            Ciherang Hills Residence Blok B7
                        </li>

                        <li class="txt14 m-b-14">
                            <i class="fa fa-phone fs-16 dis-inline-block size19" aria-hidden="true"></i>
                            (+62) 878-8482-6721
                        </li>

                        <li class="txt14 m-b-14">
                            <i class="fa fa-envelope fs-13 dis-inline-block size19" aria-hidden="true"></i>
                            Muhammadrafly84@gmail.com
                        </li>
                    </ul>

                    <!-- - -->
                    <h4 class="txt13 m-b-32">
                        Closing Time
                    </h4>

                    <ul>
                        <li class="txt14">
                            7:00 PM
                        </li>

                        <li class="txt14">
                            Every Day
                        </li>
                    </ul>
                </div>


                <div class="col-sm-6 col-md-4 p-t-50">
                    <!-- - -->
                    <h4 class="txt13 m-b-38">
                        Our Menu
                    </h4>

                    <!-- Gallery footer -->
                    <div class="wrap-gallery-footer flex-w">
                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-01.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-01.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-02.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-02.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-03.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-03.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-04.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-04.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-05.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-05.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-06.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-06.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-07.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-07.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-08.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-08.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-09.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-09.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-10.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-10.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-11.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-11.jpg') }}" alt="GALLERY">
                        </a>

                        <a class="item-gallery-footer wrap-pic-w"
                            href="{{ asset('landing-page/images/photo-gallery-12.jpg') }}"
                            data-lightbox="gallery-footer">
                            <img src="{{ asset('landing-page/images/photo-gallery-thumb-12.jpg') }}" alt="GALLERY">
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </footer>


    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>

    <!-- Modal Video 01-->
    <div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog" role="document" data-dismiss="modal">
            <div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

            <div class="wrap-video-mo-01">
                <div class="w-full wrap-pic-w op-0-0"><img src="{{ asset('landing-page/images/icons/video-16-9.jpg') }}" alt="IMG"></div>
                <div class="video-mo-01">
                    <iframe src="https://www.youtube.com/embed/5k1hSu2gdKE?rel=0&amp;showinfo=0"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('landing-page/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('landing-page/js/slick-custom.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="{{ asset('landing-page/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/lightbox2/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('landing-page/js/main.js') }}"></script>

</body>

</html>
