@extends('layouts.dashmaster')
@section('dash-home', 'Dashboard')
@section('name', 'Home')
<br>
@section('body')
    <h1 class="mt-3">Welcome <span class="text-warning">{{ Auth::user()->name }} </span>to Q-shop Dashboard</h1>

    <div class="p-5"></div>
    <div class="row">
        <div class="col-6">

            @if (Auth::user()->role == 'superadmin')
                <div  class="d-flex">
                    <i class='bx bx-layer fs-5 fs-3 me-3 text-warning '></i>
                    <p>Products Section</p>
                </div>
                <div  class="d-flex">
                    <i class='bx bx-grid-alt nav_icon fs-3 me-3 text-warning '></i>
                    <p>Categories Section</p>
                </div>
                <div class="d-flex">
                    <i class="fa-solid fa-users fs-4 me-3 text-warning "></i>
                    <p>Users Section</p>
                </div>
                <div  class="d-flex">
                    <i class='bx bx-message-square-detail nav_icon fs-3 me-3 text-warning '></i>
                    <p>Comments Section</p>
                </div>
            @elseif (Auth::user()->role == 'admin')

            <div class="d-flex">
                <i class='bx bx-layer fs-3 me-3 text-warning '></i>

                <p> Your Products Section</p>
            </div>
            <div  class="d-flex">
                <i class='bx bx-grid-alt fs-3 me-3 nav_icon text-warning '></i>
                <p class="me-2">Categories Section</p>
                <p class="fs-6 text-secondary ">(read only)</p>
            </div>
            <div  class="d-flex">
                <i class="fa-solid fa-users fs-4 me-3 text-warning "></i>
                <p>Your Account Section</p>
            </div>
            <div  class="d-flex">
                <i class='bx bx-message-square-detail nav_icon fs-3 me-3 text-warning '></i>
                <p>Your Product,s Comments Section</p>
            </div>

            @endif
        </div>

        @if (Auth::user()->role == 'admin')

        <div class="col-6 d-flex">
            <p class="me-3">

                you have <span class="text-warning">{{count(App\Models\Product::where('user_id',Auth::user()->id)->get())}}</span> Product/s
            </p>



            <a class="text-warning  fw-bold" href="{{ route('products.create') }}">Add New one ?</a>




        </div>
        @endif



    </div>
@endsection
