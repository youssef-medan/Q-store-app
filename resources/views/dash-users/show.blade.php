@extends('layouts.dashmaster')
@section('dash-home', $user->name)
@section('name', $user->name)
@section('body')

<style>
    .main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>


    <div class="container">
        <div class="main-body mt-5">


            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/users">Users /</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }},s Profile</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
            <h3 class="">Role : {{ $user->role }}</h3>

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Admin"
                                    class="rounded-circle" height="250" width="250">

                                @else
                                <img src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg" alt="Admin"
                                class="rounded-circle" width="150">

                                @endif

                                <div class="mt-3">
                                    <h4>{{ $user->name }}</h4>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->mobile }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->address }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-warning "
                                        href="{{route('users.edit',$user->id)}}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if ($user->role == 'user')

                        <p class="fs-3">{{ $user->name . ' ' }} shoping cart :</p>
                        <div class="row gutters-sm">

                            <div class="col-sm-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-between flex-wrap ">
                                        @forelse ($user->shopingCartProducts as $cart)
                                            <div class="card m-2" style="width:25%;">
                                                @if ($cart->image)
                                                    <img class="card-img-top"
                                                        src="{{ asset('storage/' . $cart->image->url) }}"
                                                        alt="Card image cap">
                                                @else
                                                    <img class=" "
                                                        src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                                        alt="">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $cart->name }}</h5>

                                                    <a href="{{ route('products.edit', $cart->id) }}"
                                                        class="btn btn-primary">View Product</a>
                                                </div>
                                            </div>

                                        @empty
                                        <p class="fs-4 text-warning">this user didn't add any product to cart</p>
                                        @endforelse


                                    </div>
                                </div>
                            </div>



                        </div>
                    @elseif ($user->role == 'admin')
                        <p class="fs-3 " >  {{ ' ' . $user->name . ' ' }}<span class="text-warning">Products :</span> </p>
                        <div class="row gutters-sm">

                            <div class="col-sm-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-between flex-wrap ">
                                        @forelse ($user->sellproducts as $sells)
                                        {{-- {{$user->sellproducts->links()}} --}}
                                            <div class="card m-2 w-25 " style=" hight:50px">
                                                @if ($sells->image)
                                                    <img class="card-img-top w-100 h-50"
                                                        src="{{ asset('storage/' . $sells->image->url) }}"
                                                        alt="Card image cap">
                                                @else
                                                    <img class=" "
                                                        src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                                        alt="">
                                                @endif

                                                    <h5 class="card-title h-25 text-center">{{ $sells->name }}</h5>

                                                    <a href="{{ route('products.show', $sells->id) }}"
                                                        class="btn btn-primary ">View Product</a>

                                            </div>

                                        @empty
                                        <p class="fs-4 text-warning">this seller didn't add any product</p>
                                        @endforelse


                                    </div>
                                </div>
                            </div>



                        </div>


                    @endif





                </div>
            </div>

        </div>
    </div>

    @endsection


