@extends('layouts.master')
@section('Home', 'Q Shop')


@section('sidebar')

    <link rel="stylesheet" type="text/css" href="{{ url('/css/category.css') }}" />



    <div class="container  ">

        <div class="text-center">
        </div>

        @if (Request::get('search'))
            <link rel="stylesheet" type="text/css" href="{{ url('/css/product.css') }}" />


            <div class="row">

                {{-- <div class="alert alert-danger m-5">{{ $message }}</div> --}}



                {{ $prouducts_search->links() }}

                <h4 class="mb-5">Results For '{{ Request::get('search') }}'</h4>
                @forelse ($prouducts_search as $prouduct_result)
                    <div class="con col-md-3 col-sm-6 mb-5 ">
                        <div class="product-grid border border-3 rounded">
                            <div class="product-image" style="background-image: url('{{ $prouduct_result->url }}');">
                                <a href="{{ route('productveiw', $prouduct_result->id) }}">
                                @if ($prouduct_result->url)
                                    <img src="{{ asset('storage/' . $prouduct_result->url) }}" alt="">
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
                                    <form method="POST" action="{{ route('addtocart') }}">
                                        @csrf
                                        <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="number" name="product_id" value="{{ $prouduct_result->id }}" hidden>
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
                                <h3 class="title"><a
                                        href="{{ route('productveiw', $prouduct_result->id) }}">{{ $prouduct_result->name }}</a>
                                </h3>
                                <div class="price">{{ $prouduct_result->price . ' EP' }}</div>
                            </div>
                        </div>
                    </div>

                @empty
                    <h2 class="text-center text-alert">No Result Found</h2>
                @endforelse

            </div>



            {{ $prouducts_search->links() }}
        @else
            {{-- normal home with categories --}}



            <div class=" row  ">

                @forelse ($cats as $cat)
                    <div class="col-3">




                        <div class=" text-center card"
                            style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url({{ asset('storage/' . $cat->url) }});">
                            {{-- <a href="{{Route('categoryveiw',$cat->id)}}"></a> --}}

                            <div class="  card-description">
                                <h2 class=" ">{{ $cat->name }}</h2>
                            </div>
                            <a class="card-link" href="{{ route('categoryveiw', $cat->id) }}"></a>
                            {{-- <a class="card-link" href="categoryveiw/{{$cat->id}}" ></a> --}}
                        </div>
                    </div>

                @empty

                    <h2 class="text-center text-alert">No Result Found</h2>
                @endforelse


            </div>




            <div class="text-center">
            </div>
        @endif
    </div>


@endsection
