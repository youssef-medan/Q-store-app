@extends('layouts.master')
@section('Home', 'Products')

@section('sidebar')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/product.css') }}" />



    <div class="container">






        <div class="bg-light position-fixed z-5" style="hight:500px;width:300px;">
            asasasasa

        </div>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>






        <div class="input-group mb-3 mt-3 d-flex justify-content-between align-items-center mb-5">
            <i onclick="change()" class="fa-solid fa-arrow-down arrow fs-2 ms-3 me-3"></i>
            <form class="ms-3" action="{{ route('allproducts') }}">
                <input type="text" name="orderby" value="atoz" hidden>
                <input class="azvalue" type="text" name="arrow" value="asc" hidden>

                <button class="button-52" type="submit" role="button">A-Z</button>



            </form>
            <form class="ms-3" action="{{ route('allproducts') }}">
                <input type="text" name="orderby" value="price" hidden>
                <input class="price" type="text" name="arrow" value="asc" hidden>

                <button class="button-52" type="submit" role="button">Price</button>


            </form>
            <form class="ms-3" action="{{ route('allproducts') }}">
                <input type="text" name="orderby" value="lastest" hidden>
                <input class="lastest" type="text" name="arrow" value="asc" hidden>

                <button class="button-52" type="submit" role="button">Lastest</button>


            </form>

            <form class="ms-3" action="{{ route('allproducts') }}">
                <label class="fs-4" for="min-price">from </label>
                <input class="inp" id="min-price" type="number" name="min" value="">
                <label class="fs-4" for="max-price">to </label>
                <input class="me-3 inp" id="max-price" type="number" name="max" value="">

                <button class="button-52" type="submit" role="button">By Price</button>

            </form>

        </div>



        {{-- <a href="{{request()->fullUrlWithQuery(['orderby' => 'price']) }}"><button class="button-52" role="button">By Price</button></a>
        <a href="{{request()->fullUrlWithQuery(['orderby' => 'lastest']) }}"><button class="button-52" role="button">lastest</button></a>
        <a  href=" {{request()->fullUrlWithQuery(['orderby' => arrow.value]) }}">  <input class="azvalue" type="text" name="arrow" value="asc" hidden>  </a>

        <a href="{{request()->fullUrlWithQuery(['search' => 'sam']) }}">ggg</a> --}}

        <h4 class="text-danger mt-2">{{ session('massage') }}</h4>
        {{ $products->links() }}
        {{-- <a href="{{request()->fullUrlWithQuery(['orderby'=>Request::get('orderby'),'arrow'=>Request::get('arrow'),'min'=>Request::get('min'),'max'=>Request::get('max')])}}">aaa</a> --}}
        {{-- <h1 class="text-center fs-1 mt-5">{{$category->name}}</h1> --}}
        <div class=" row  ">
            @foreach ($products as $product)
                <div class="con col-md-3 col-sm-6 mb-5">
                    <a id="{{ $product->id }}"></a>
                    <div class="product-grid border border-3 rounded">

                        <div class="product-image" style="background-image: url('{{ $product->url }}');">
                            <a href="{{ route('productveiw', $product->id) }}">
                                @if ($product->url)
                                    <img src="{{ asset('storage/' . $product->url) }}" alt="">
                                @else

                                    <img class=""
                                        src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                        alt="">
                                @endif
                            </a>
                            {{-- <ul class="product-links">
                            <li><a href="#"><i class="fa fa-search"></i></a></li>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul> --}}
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
                                        add
                                    </button>
                                    </a>
                            @endif

                        </div>
                        <div class="product-content">
                            {{-- {{route('categoryveiw',$cat->id)}} --}}
                            <h3 class="title"><a href="{{ route('productveiw', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="price">{{ $product->price . ' EP' }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- {{$cat_product->name}} --}}

        </div>
        {{ $products->links() }}

    </div>

    @if (Request::get('arrow') == 'desc')
        <script>
            let arrwo = document.getElementsByClassName("arrow")[0];
            let azvalue = document.getElementsByClassName("azvalue")[0];
            let lastest = document.getElementsByClassName("lastest")[0];
            let price = document.getElementsByClassName("price")[0];

            azvalue.value = 'desc'
            lastest.value = 'desc'
            price.value = 'desc'

            arrwo.style.transform = "rotate(180deg)"

            function change() {
                let arrwo = document.getElementsByClassName("arrow")[0];


                if (azvalue.value == 'asc' || lastest.value == 'asc' || price.value == 'asc') {
                    let arrwo = document.getElementsByClassName("arrow")[0];

                    azvalue.value = 'desc'
                    lastest.value = 'desc'
                    price.value = 'desc'

                    arrwo.style.transform = "rotate(180deg)"


                } else if (azvalue.value == 'desc' || lastest.value == 'desc' || price.value == 'desc') {
                    let arrwo = document.getElementsByClassName("arrow")[0];


                    azvalue.value = 'asc'
                    lastest.value = 'asc'
                    price.value = 'asc'

                    arrwo.style.transform = "rotate(360deg)"


                }




            }
        </script>
    @endif
    <script>
        let arrwo = document.getElementsByClassName("arrow")[0];
        let azvalue = document.getElementsByClassName("azvalue")[0];
        let lastest = document.getElementsByClassName("lastest")[0];
        let price = document.getElementsByClassName("price")[0];




        function change() {
            let arrwo = document.getElementsByClassName("arrow")[0];


            if (azvalue.value == 'asc' || lastest.value == 'asc' || price.value == 'asc') {
                let arrwo = document.getElementsByClassName("arrow")[0];

                azvalue.value = 'desc'
                lastest.value = 'desc'
                price.value = 'desc'

                arrwo.style.transform = "rotate(180deg)"


            } else if (azvalue.value == 'desc' || lastest.value == 'desc' || price.value == 'desc') {
                let arrwo = document.getElementsByClassName("arrow")[0];


                azvalue.value = 'asc'
                lastest.value = 'asc'
                price.value = 'asc'

                arrwo.style.transform = "rotate(360deg)"


            }




        }



        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
@endsection
