@extends('layouts.dashmaster')
@section('dash-home', 'Products')
@section('name', Auth::user()->role =='admin'? 'Your products':'Products')
<br>
@section('body')

    <style>
        .btn:hover {
            color: #fff;
        }

        .input-text:focus {


            box-shadow: 0px 0px 0px;
            border-color: #f8c146;
            outline: 0px;
        }

        .form-control {
            border: 1px solid #f8c146;
        }

        .pagination>li>a,
        .pagination>li>span {
            color: #f8c146; // use your own color here
        }

        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover {
            background-color: #f8c146;
            border-color: #f8c146;
        }
    </style>


    <div class="">
        @if (session()->has('status'))
        <div class="flex-initial max-w-full text-xl font-normal fs-3 text-warning">
            {{ session('status') }}</div>

        @endif

        <div class="d-flex justify-content-center">

            <button class="btn btn-warning rounded mb-5 ">
                <a class="text-dark fw-bold" href="{{ route('products.create') }}">Add New Product</a>

            </button>

        </div>



        <form  action="{{route('products.index')}}">





            <div class="d-flex justify-content-center ">

                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control input-text" name="search" placeholder="Search products...."
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-warning btn-lg" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>

            </div>
        </form>






        {{ $products->links() }}


        <table class="table  table-striped table-hover table align-middle">
            <thead class="text-warning">
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th class="" scope="col">Price</th>
                    <th class=" ps-5"scope="col">View</th>
                    <th scope="col">Category</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Description</th>
                    <th class="" scope="col">Created_at</th>

                    <th scope="col">Options</th>

                </tr>
            </thead>
            <tbody class="">
                @forelse ($products as $key => $product )
                    <tr>


                        <td class="fs-6 text-warning">{{ $loop->iteration }}</td>
                        <td class="fs-6"><a href="{{route('products.show',$product->id)}}">{{ $product->name }}</a> </td>
                        <td class="fs-6">{{ $product->price }}</td>



                        <td class="fs-6">
                            @if ($product->images)
                                @foreach ($product->images as $image)
                                    <img style="width: 200px" class=" px-5 d-inline" src="{{ asset('storage/' . $image->url) }}"
                                        alt="">
                                @endforeach
                            @else
                                <img class="100 px-5"
                                    src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                    alt="">
                            @endif

                        </td>

                        <td  class="fs-6"> {{ $product->category->name }}</td>
                        <td class="fs-6"><a href="{{route('users.show',$product->user->id)}}">{{ $product->user->name }}</a> </td>
                        <td class="fs-6">{{ $product->description }}</td>
                        <td class="fs-6">{{ $product->created_at }}</td>


                        <td>
                            <div class="d-flex flex-column align-items-center ">

                                <div>
                                    <form action="">
                                    <a href="{{ route('products.edit', $product->id) }}"> <i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                        </form>

                                </div>
                                <div>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit"> <i class="fa-solid fa-trash"
                                                style="color: #e02f18;"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>

                    @empty
                    <td colspan="9" class="text-center fs-2 text-danger">

                       no product found
                    </td>


                @endforelse


                </tr>
            </tbody>
        </table>
        {{ $products->links() }}

    </div>
@endsection
