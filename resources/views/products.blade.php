@extends('layouts.master')
{{-- {{$name = }} --}}
@section('Home',App\Models\Category::where('id',$products[0]->category_id)->first('name')->name)

@section('sidebar')

        <link rel="stylesheet" type="text/css" href="{{ url('/css/product.css') }}" />



    <div class="container">
        {{-- <h1 class="text-center fs-1 mt-5">{{$category->name}}</h1> --}}
        <div class=" row  ">
            @foreach ($products as $product)

            <div class="con col-md-3 col-sm-6 mb-5">
                <div class="product-grid border border-3 rounded">
                    <div class="product-image" style="background-image: url('{{$product->url}}');">
                        <a href="{{route('productveiw',$product->id)}}" class="image">
                            @if ($product->image)

                                <img  src="{{asset('storage/' . $product->image->url)}}" alt="">
                            @else
                            <img class="100 px-5"
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

                        <form method="POST" action="{{route('addtocart')}}">
                            @csrf
                            <input type="number" name="user_id" value="{{Auth::user()->id}}" hidden>
                            <input type="number" name="product_id" value="{{$product->id}}" hidden>
                            <button class="add-to-cart" type="submit">

                                add
                            </button>
                        </form>
                        @else
                        <a class="" href="{{route('webregister')}}">
                            <button class="add-to-cart" type="submit">
                                add
                            </button>
                            </a>

                        @endif

                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{route('productveiw',$product->id)}}">{{$product->name}}</a></h3>
                        <div class="price">{{$product->price ." EP"}}</div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- {{$cat_product->name}} --}}

        </div>
    </div>
@endsection
