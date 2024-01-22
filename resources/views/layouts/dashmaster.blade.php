<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('dash-home')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        :root {
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color: #efa104;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        a {
            text-decoration: none
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s
        }

        .header_toggle {
            color: var(--first-color);
            font-size: 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_img img {
            width: 40px
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed)
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }

        .nav_logo {
            margin-bottom: 2rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }

        .nav_link:hover {
            color: var(--white-color)
        }

        .nav_icon {
            font-size: 1.25rem
        }

        .show {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: var(--white-color)
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }

        .height-100 {
            height: 100vh
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }
    </style>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        // const linkColor = document.querySelectorAll('.nav_link')

        // function colorLink() {
        //     if (linkColor) {
        //         linkColor.forEach(l => l.classList.remove('active'))
        //         this.classList.add('active')
        //     }
        // }
        // linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
</script>



<body id="body-pd">
    <header class="header m-b5" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        @if (Auth::user())
            <div class="d-flex justify-content-center align-items-center  w-100">
                @if (Auth::user()->profile_picture)
                    <div class="header_img  "> <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                            alt=""> </div>
                @else
                    <div class="header_img"> <img src="https://static.thenounproject.com/png/354384-200.png"
                            alt=""> </div>
                @endif


                <a class="fs-3 text-warning ms-2 mt-3 "
                    href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}</p>

            </div>
        @endif
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="/dashboard" class="nav_logo"> <i
                        class="fa-solid fa-house {{ Request::is('dashboard') ? 'nav_logo-icon' : 'text-secondary' }}"></i>
                    <span class="nav_logo-name">Q-Shop</span> </a>
                <div class="nav_list"> <a href="/dashboard/products"
                        class="nav_link {{ Request::is('dashboard/products') || Request::is('dashboard/products/create') || Request::is('dashboard/products/') ? 'active' : '' }}">
                        <i class='bx bx-layer fs-5 '></i>
                        <span class="nav_name">Products</span> </a>
                    <a href="/dashboard/categories"
                        class="nav_link {{ Request::is('dashboard/categories') || Request::is('dashboard/categories/create') || Request::is('dashboard/categories/edit') ? 'active' : '' }} ">
                        <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Categories</span> </a>
                    <a href="/dashboard/users"
                        class="nav_link  {{ Request::is('dashboard/users') || Request::is('dashboard/users/create') || Request::is('dashboard/users/edit') || Request::is('dashboard/users/show') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i> <span class="nav_name">Users</span> </a> <a
                        href="/dashboard/comments" class="nav_link {{Request::is('dashboard/comments') ? 'active':''}}"> <i
                            class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Comments</span>
                    </a> <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                            class="nav_name">Bookmark</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> <a
                        href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                </div>
            </div>
            @if (Auth::user())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav_link btn"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">SignOut</span> </button>
                </form>
            @else
            @endif
        </nav>
    </div>
    <!--Container Main start-->
    <div class=" bg-light rounded ">
        <div class="container pt-5 mt-3">

            <h4>@yield('name')</h4>
            @section('body')
            @show







        </div>

    </div>

    <!--Container Main end-->
