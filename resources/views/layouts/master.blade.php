<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title> @yield('Home')</title>
    <link href="https://cdn.jsdelivr.xyz/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        .dropdown-hover-all .dropdown-menu,
        .dropdown-hover>.dropdown-menu.dropend {
            margin-left: -1px !important
        }
    </style>
    <style>
        body {
            /* margin-top: 20px; */
        }

        .deneb_footer .widget_wrapper {
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 200px;
            padding-bottom: 1px;
        }

        @media (max-width: 767px) {
            .deneb_footer .widget_wrapper .widget {
                margin-bottom: 40px;
            }
        }

        .deneb_footer .widget_wrapper .widget .widget_title {
            margin-bottom: 30px;
        }

        .deneb_footer .widget_wrapper .widget .widget_title h4 {
            font-weight: bold;
        }

        .deneb_footer .widget_wrapper .widget .widget_title h4:after {
            content: "";
            display: block;
            max-width: 38px;
            height: 2px;
            margin-top: 5px;
        }

        .deneb_footer .widget_wrapper .widegt_about p {
            margin-bottom: 20px;
        }

        .deneb_footer .widget_wrapper .widegt_about .social li {
            display: inline-block;
            margin-right: 10px;
        }

        .deneb_footer .widget_wrapper .widegt_about .social li a {
            display: block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            background-color: #f9e6d4;
            color: #fba543;
            font-size: 14px;
            -webkit-transition: all all 0.5s ease-out 0s;
            -moz-transition: all all 0.5s ease-out 0s;
            -ms-transition: all all 0.5s ease-out 0s;
            -o-transition: all all 0.5s ease-out 0s;
            transition: all all 0.5s ease-out 0s;
        }

        .deneb_footer .widget_wrapper .widegt_about .social li a:hover,
        .deneb_footer .widget_wrapper .widegt_about .social li a:focus {
            background-image: -moz-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            background-image: -webkit-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            background-image: -ms-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            color: #fff;
            box-shadow: 2.5px 4.33px 15px 0px rgba(254, 176, 0, 0.4);
        }

        .deneb_footer .widget_wrapper .widget_link ul li {
            margin-bottom: 5px;
        }

        .deneb_footer .widget_wrapper .widget_link ul li a {
            text-transform: capitalize;
            color: #7a808d;
        }

        .deneb_footer .widget_wrapper .widget_link ul li a:hover,
        .deneb_footer .widget_wrapper .widget_link ul li a:focus {
            color: #feb000;
        }

        .deneb_footer .widget_wrapper .widget_contact .contact_info .single_info {
            max-width: 250px;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .deneb_footer .widget_wrapper .widget_contact .contact_info .single_info .icon {
            font-size: 12px;
            color: #feb000;
            margin-right: 10px;
        }

        .deneb_footer .widget_wrapper .widget_contact .contact_info .single_info .info p a {
            color: #7a808d;
        }

        .deneb_footer .widget_wrapper .widget_contact .contact_info .single_info .info p span {
            display: block;
        }

        .deneb_footer .copyright_area {
            background: #edecf0;
            padding: 10px 0;
        }

        .deneb_footer .copyright_area .copyright_text {
            text-align: center;
        }

        .deneb_footer .copyright_area .copyright_text p {
            color: #011a3e;
        }

        .deneb_footer .copyright_area .copyright_text p span {
            color: #feb000;
        }

        .deneb_cta .cta_wrapper {
            padding: 45px 50px 42px;
            max-width: 970px;
            border-radius: 15px;
            margin: auto;
            margin-bottom: -135px;
            position: relative;
            background-image: -moz-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            background-image: -webkit-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            background-image: -ms-linear-gradient(0deg, #ffbd27 0%, #feb000 100%);
            box-shadow: 2.5px 4.33px 15px 0px rgba(254, 176, 0, 0.4);
            z-index: 1;
        }

        .deneb_cta .cta_wrapper:after {
            content: "";
            background-position: bottom;
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .deneb_cta .cta_wrapper .cta_content h3 {
            color: #fff;
            font-weight: bold;
        }

        @media (max-width: 767px) {
            .deneb_cta .cta_wrapper .cta_content h3 {
                font-size: 24px;
            }
        }

        .deneb_cta .cta_wrapper .cta_content h3:after {
            content: "";
            display: block;
            max-width: 110px;
            height: 2px;
            margin-top: 13px;
            margin-bottom: 24px;
        }

        .deneb_cta .cta_wrapper .cta_content p {
            color: #fff;
        }

        .deneb_cta .cta_wrapper .button_box {
            float: right;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .deneb_cta .cta_wrapper .button_box {
                float: none;
                text-align: left;
                margin-top: 30px;
            }
        }

        @media (max-width: 767px) {
            .deneb_cta .cta_wrapper .button_box {
                float: none;
                text-align: center;
                margin-top: 30px;
            }
        }

        .deneb_cta .cta_wrapper .button_box .deneb_btn {
            background: #fff;
            color: #011a3e;
        }

        .deneb_cta .cta_wrapper .button_box .deneb_btn:hover,
        .deneb_cta .cta_wrapper .button_box .deneb_btn:focus {
            box-shadow: 2.5px 4.33px 15px 0px rgba(0, 0, 0, 0.15);
        }

        /* nav style */
        a {
            font-size: 14px;
            font-weight: 700
        }

        .superNav {
            font-size: 13px;
        }

        .form-control {
            outline: none !important;
            box-shadow: none !important;
        }

        @media screen and (max-width:540px) {
            .centerOnMobile {
                text-align: center
            }

            /* .con{margin-bottom: 150px;}
      .fot{margin-top: 150px} */
        }

        .small_pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <nav>
        <div class="superNav border-bottom py-2 bg-light ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 centerOnMobile">
                        <select class="me-3 border-0 bg-light">
                            <option value="en-us">EN-US</option>
                        </select>
                        <span
                            class="d-none d-lg-inline-block d-md-inline-block d-sm-inline-block d-xs-none me-3"><strong>ymedan.ym@gmail.com</strong></span>
                        <span class="me-3"><i class="fa-solid fa-phone me-1 text-warning"></i>
                            <strong>01011017386</strong></span>
                    </div>
                    <div
                        class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block d-md-block-d-sm-block d-xs-none text-end">
                        <span class="me-3"><i class="fa-solid fa-truck text-muted me-1"></i><a class="text-muted"
                                href="#">Shipping</a></span>
                        <span class="me-3"><i class="fa-solid fa-file  text-muted me-2"></i><a class="text-muted"
                                href="#">Policy</a></span>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm mb-5 ">
            <div class="container d-flex align-items-baseline">
                <a class="navbar-brand" href="{{ route('home') }}"><i class="fa-solid fa-shop me-2"></i> <strong>Q
                        SHOP</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="mx-auto my-3">

                    <form class="input-group" action="{{ route('home') }}">
                        @csrf
                        <span class="border-warning input-group-text bg-warning text-white"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" value="{{ request()->get('search') }}" name="search"
                            class="form-control border-warning" style="color:#7a7a7a">
                        <button class="btn btn-warning text-white" type="submit">Search</button>

                    </form>

                </div>
                <div class=" collapse navbar-collapse d-flex align-items-baseline" id="navbarNavDropdown">


                    <ul class="navbar-nav ms-auto d-flex align-items-baseline">
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase {{ Request::is('/') ?'active':''}}" aria-current="page"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase {{ Request::is('allproducts') ?'active':''}}" href="{{ route('allproducts') }}">Products</a>
                        </li>
                        <li class="nav-item">




                            <div class="d-flex dropdown-hover-all">
                                <div class="dropdown mt-3">

                                    <button class="btn dropdown-toggle nav-link mx-2 text-uppercase" type="button"
                                        id="dropdownMenuButton222" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Catalog
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton222">
                                        @foreach ($dropCategories as $category)
                                            <div class="dropdown dropend">

                                                <a class="dropdown-item dropdown-toggle"
                                                    href="{{ route('categoryveiw', $category->id) }}"
                                                    id="dropdown-layouts" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">{{ $category->name }}</a>
                                                <div class="dropdown-divider"></div>

                                                <div class="dropdown-menu" aria-labelledby="dropdown-layouts">
                                                    <div class="container">

                                                        <a class="dropdown-item  fs-6 text-center bg-warning container rounded"
                                                            href="{{ route('categoryveiw', $category->id) }}">Shop
                                                            Now</a>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    @foreach ($category->sub_categories as $subCategory)
                                                        <a class="dropdown-item"
                                                            href="/categoryveiw/products/{{ $subCategory->id }}">{{ $subCategory->name }}</a>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>



                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="/dashboard">Join Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto d-flex align-items-baseline ">
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase postion-relative {{ Request::is('shopingcart') ?'active':''}}"
                                href="{{ route('shopingcart') }}">
                                <i class="fa-solid fa-cart-shopping me-1 postion-relative"></i>
                                Cart
                                @if (Auth::user())
                                    <span
                                        class="badge rounded-pill text-bg-danger">{{ count(App\Models\ShopingCart::where('user_id', Auth::user()->id)->get('id')) }}</span>
                                @endif


                            </a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item">
                                @if (Auth::user()->profile_picture)
                                    <a class="nav-link mx-2 text-uppercase {{ Request::is('profile/*') ?'active':''}}"
                                        href="{{ route('profile.show', Auth::user()->id) }}"> <img class="small_pic"
                                            src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                            alt=""> {{ Auth::user()->name }}</a>
                                @else
                                    <a class="nav-link mx-2 text-uppercase {{ Request::is('profile/*') ?'active ':''}} "
                                        href="{{ route('profile.show', Auth::user()->id) }}"> <img class="small_pic"
                                            src="https://static.thenounproject.com/png/354384-200.png" alt="">
                                        {{ Auth::user()->name }}</a>
                                @endif
                            </li>
                            <form action="{{ route('weblogout') }}">
                                <i class=""></i><button class="btn btn-danger">logout</button>
                            </form>
                        @else
                            <li class="nav-item">
                                <a class="nav-link mx-2 text-uppercase {{ Request::is('web/register') ?'active':''}}" href="{{ route('webregister') }}"><i
                                        class="fa-solid fa-circle-user me-1"></i> register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2 text-uppercase {{ Request::is('web/login') ?'active':''}} " href="{{ route('weblogin') }}"><i
                                        class="fa-solid fa-circle-user me-1 "></i>login</a>
                            </li>

                        @endif
                        <li class="nav-item">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @error('search')
            <div class="alert alert-danger mb-5">{{ $message }}</div>
        @enderror

        {{-- ------------------------------------------------------------------------ --}}
        <section class="">

            @section('sidebar')
                This is the master sidebar.
            @show


            <div class="container">
                @yield('content')
            </div>

        </section>


        {{-- ------------------------------------------------------------------------ --}}


        <div class="mt-5">
            <section class="deneb_cta">
                <div class="container">
                    <div class="cta_wrapper">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="cta_content">
                                    <h3>Have Any Project in Mind ?</h3>
                                    <p>Curabitur libero eros, efficitur sit amet sodales tincidunt, aliquet et leo sed
                                        ut nibh feugiat, auctor enim quis.</p>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="button_box">
                                    <a href="#" class="btn btn-warning">Hire Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="deneb_footer">
                <div class="widget_wrapper"
                    style="background-image: url(http://demo.tortoizthemes.com/deneb-html/deneb-ltr/assets/images/footer_bg.png);">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="widget widegt_about">
                                    <div class="widget_title">
                                        <img src="assets/images/logo_1.png" class="img-fluid" alt="">
                                    </div>
                                    <p>Quisque orci nisl, viverra et sem ac, tincidunt egestas massa. Morbi est arcu,
                                        hendrerit ac vehicula condimentum, euismod nec tortor praesent consequat urna.
                                    </p>
                                    <ul class="social">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="widget widget_link">
                                    <div class="widget_title">
                                        <h4>Links</h4>
                                    </div>
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Portfolio</a></li>
                                        <li><a href="#">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="widget widget_contact">
                                    <div class="widget_title">
                                        <h4>Contact Us</h4>
                                    </div>
                                    <div class="contact_info">
                                        <div class="single_info">
                                            <div class="icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                            <div class="info">
                                                <p><a href="tel:+919246147999">1800-121-3637</a></p>
                                                <p><a href="tel:+919246147999">+91 924-614-7999</a></p>
                                            </div>
                                        </div>
                                        <div class="single_info">
                                            <div class="icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="info">
                                                <p><a href="mailto:info@deneb.com">info@deneb.com</a></p>
                                                <p><a href="mailto:services@deneb.com">services@deneb.com</a></p>
                                            </div>
                                        </div>
                                        <div class="single_info">
                                            <div class="icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="info">
                                                <p>125, Park street aven, Brocklyn,<span>Newyork.</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright_area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright_text">
                                    <p>Copyright &copy; 2020 All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>

        <script>
            (function($bs) {
                const CLASS_NAME = 'has-child-dropdown-show';
                $bs.Dropdown.prototype.toggle = function(_orginal) {
                    return function() {
                        document.querySelectorAll('.' + CLASS_NAME).forEach(function(e) {
                            e.classList.remove(CLASS_NAME);
                        });
                        let dd = this._element.closest('.dropdown').parentNode.closest('.dropdown');
                        for (; dd && dd !== document; dd = dd.parentNode.closest('.dropdown')) {
                            dd.classList.add(CLASS_NAME);
                        }
                        return _orginal.call(this);
                    }
                }($bs.Dropdown.prototype.toggle);

                document.querySelectorAll('.dropdown').forEach(function(dd) {
                    dd.addEventListener('hide.bs.dropdown', function(e) {
                        if (this.classList.contains(CLASS_NAME)) {
                            this.classList.remove(CLASS_NAME);
                            e.preventDefault();
                        }
                        e.stopPropagation(); // do not need pop in multi level mode
                    });
                });

                // for hover
                document.querySelectorAll('.dropdown-hover, .dropdown-hover-all .dropdown').forEach(function(dd) {
                    dd.addEventListener('mouseenter', function(e) {
                        let toggle = e.target.querySelector(':scope>[data-bs-toggle="dropdown"]');
                        if (!toggle.classList.contains('show')) {
                            $bs.Dropdown.getOrCreateInstance(toggle).toggle();
                            dd.classList.add(CLASS_NAME);
                            $bs.Dropdown.clearMenus();
                        }
                    });
                    dd.addEventListener('mouseleave', function(e) {
                        let toggle = e.target.querySelector(':scope>[data-bs-toggle="dropdown"]');
                        if (toggle.classList.contains('show')) {
                            $bs.Dropdown.getOrCreateInstance(toggle).toggle();
                        }
                    });
                });
            })(bootstrap);
        </script>
</body>

</html>
