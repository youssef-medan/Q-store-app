@extends('layouts.master')
@section('Home', 'Cart')
@section('sidebar')
    <style>


    </style>





    <div class="container">

        <section class="pt-5 pb-5 ">
            <div class="container">
                <div class="row w-100">
                    <div class="col-lg-12 col-md-12 col-12">
                        <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                        <p class="mb-5 text-center">
                            <i class="text-warning font-weight-bold fs-3">{{ count($cart) }}</i> items in your cart
                        </p>
                        <table id="shoppingCart" class="table table-condensed table-responsive text-center">
                            <thead>
                                <tr>
                                    <th style="width:30%">Product</th>
                                    <th style="width:12%">Price</th>
                                    <th style="width:12%">Quantity</th>
                                    <th style="width:12%">Subtotal</th>
                                    <th style="width:16%"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <div hidden>
                                    {{ $total = 0 }}
                                </div>

                                @forelse ($cart as $product)
                                    <tr >
                                        <a  id="{{$product->pivot->id}}" name="{{$product->pivot->id}}"></a>

                                        <td  data-th="Product">
                                            <div class="row">
                                                <div class="col-md-3 text-left">
                                                    <a href="{{ route('productveiw', $product->id) }}">
                                                        {{-- <img src="{{$product->url}}" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow "> --}}
                                                        @if ($product->image)
                                                            <img width="100" height="100" class=" d-none d-md-block rounded mb-2 shadow"
                                                                src="{{ asset('storage/' . $product->image->url) }}"
                                                                alt="">
                                                        @else
                                                            <img class="img-fluid d-none d-md-block rounded mb-2 shadow"
                                                                src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                                                alt="">
                                                        @endif

                                                    </a>
                                                </div>
                                                <div class="col-md-9 text-left mt-sm-2">
                                                    <h4><a
                                                            href="{{ route('productveiw', $product->id) }}"></a>{{ $product->name }}
                                                    </h4>
                                                    <p class="font-weight-light">{{ $product->cat }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">{{ $product->price }}</td>



                                        <td data-th="Quantity">
                                            <div class="d-flex align-items-center">

                                                <div class="">
                                                    <input type="number" class="form-control form-control-md text-center " readonly
                                                value="{{$product->pivot->quantity}}">
                                                </div>
                                                <div class="ms-3">
                                                    <form action="{{route('shopingcartplus',$product->pivot->id)}}" method="post">
                                                        @csrf
                                                        {{-- <input name="cart_id" value="{{$product->pivot->id}}" hidden> --}}
                                                        <button type="submit" class="btn btn-white  btn-sm">
                                                            <i class="fa-solid fa-arrow-up"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{route('shopingcartminus',$product->pivot->id)}}" method="post">
                                                        @csrf
                                                        {{-- <input name="cart_id" value="{{$product->pivot->id}}" hidden> --}}
                                                        <button type="submit" class="btn btn-white  btn-sm">
                                                            <i class="fa-solid fa-arrow-down"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="" data-th="Price">{{$product_subtotal = $product->price * $product->pivot->quantity }}</td>

                                        <div hidden>
                                            {{ $total = $total + $product_subtotal}}
                                        </div>




                                        <td  class="actions text-center " data-th="">
                                            <div class="mt-4">
                                                <form action="{{ route('shopingcartdelete', $product->pivot->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('Delete')
                                                    <button type="submit"
                                                        class="btn btn-danger border-secondary  btn-md mb-2">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h2>your cart empty</h2>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right text-right">
                            <h4>Subtotal:</h4>
                            <h1>{{ $total }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex align-items-center">
                    <div class="col-sm-6 order-md-2 text-right">
                        <a href="catalog.html" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
                    </div>
                    <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                        <a href="{{ url()->previous() }}">
                            <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                    </div>
                </div>
            </div>
        </section>







    </div>




@endsection
