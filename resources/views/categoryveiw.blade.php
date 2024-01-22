@extends('layouts.master')
@section('Home', $category->name)
@section('sidebar')


    <style>
        .padded {
            padding: 100px 0;
        }

        .wrapper-grey {
            background: #F4F4F4;
        }

        .avatar {
            width: 30px;
            border-radius: 50%;
        }

        .avatar-bordered {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            border: white 1px solid;
        }

        .avatar-large {
            width: 50px;
        }

        .card {
            height: 250px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
            background-size: cover !important;
            color: white;
            position: relative;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-user {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .card-category {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 20px;
        }

        .card-description {
            position: relative;
            top: 50%;

            /* bottom: 10px; */
            /* left: 10px; */
        }

        .card-description h2 {
            font-size: 25px;
        }

        .card-description p {
            font-size: 15px;
        }

        .card-link {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            z-index: 2;
            background: black;
            opacity: 0;
        }

        .card-link:hover {
            opacity: 0.1;
        }

        .features img {
            width: 100px;
        }

        .features h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .features p {
            font-size: 15px;
            font-weight: lighter;
        }

        /* .con{margin-bottom: 150px;}
              .fot{margin-top: 150px} */
    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/product.css') }}" />


    <div class="container">
        <h1 class="text-center fs-1 mt-5 mb-5">{{ $category->name }}</h1>
        <div class=" row  ">
            @foreach ($categoryProduct as $subcat)
                <div class="col-3 w-50">


                    <div class=" text-center card"
                        style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url({{ asset('storage/' . $subcat->category_image->url) }});">
                        {{-- <a href="{{Route('categoryveiw',$cat->id)}}"></a> --}}

                        <div class="  card-description">
                            <h2 class=" ">{{ $subcat->name }}</h2>
                        </div>
                        <a class="card-link" href="products/{{ $subcat->id }}"></a>
                    </div>
                </div>
            @endforeach



        </div>


        <div class="row mt-5">

            <h2>best <span class="text-warning">{{ $category->name}}</span> products </h2>
            @foreach ($categoryProduct as $subcat)
                @foreach ($subcat->products as $product)
                    <div class="con col-md-3 col-sm-6 mb-5">
                        <a id="{{ $product->id }}"></a>
                        <div class="product-grid border border-3 rounded">

                            @if ($product->image)
                            <div class="product-image" style="background-image: url('{{ $product->image->url }}');">
                                    <img src="{{ asset('storage/' . $product->image->url) }}" alt="">
                                @else
                                <div class="product-image"  style="background-image: url('https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg');">
                                    <img class=""
                                        src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                        alt="">
                                @endif

                                @if (Auth::user())
                                    <form method="POST" action="{{ route('addtocart') }}">
                                        @csrf
                                        <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="number" name="product_id" value="{{ $product->id }}" hidden>
                                        <button class="add-to-cart" type="submit">

                                            add
                                        </button>
                                    </form>
                                @else
                                <a class="add-to-cart" href="{{ route('webregister') }}">

                                    <button class="add-to-cart" type="submit">
                                        Add

                                    </button>
                                    </a>
                                @endif

                            </div>
                            <div class="product-content">
                                <h3 class="title"><a
                                        href="{{ route('productveiw', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="price">{{ $product->price . ' EP' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>

    </div>







@endsection
