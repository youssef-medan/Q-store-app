@extends('layouts.dashmaster')
@section('dash-home', 'Edit Product')
@section('name', 'Edit Product : ' . $product->name)
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">

        <div class=" mb-3 row border">
            <label class="">photo of product :</label>
            @if ($product->images)
                @foreach ($product->images as $image)
                <div class="d-flex col-4 py-4">

                    <img class="rounded" width="250" height="400" src="{{ asset('storage/' . $image->url) }}" alt="">

                </div>
                @endforeach
            @else
                <p>this product has no photo, please add</p>
            @endif
        </div>


            <div class="col-6 row mb-3">
                <label class="col-3">Product Name :</label>
                <p  class="border border-warning rounded col-8"> {{ $product->name}}   </p>


            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">Category :</label>
                <p  class="border border-warning rounded col-8"> {{ $product->category->name}}   </p>

            </div>

            <div class="col-6 row mb-3">
                <label class="col-3">Price :</label>
                <p  class="border border-warning rounded col-8"> {{$product->price}}   </p>

            </div>






            <div class="col-6 row mb-3" >
                <label class="col-3">Description :</label>
                <div  class="border border-warning rounded col-8">  {{$product->description}}  </div>




            </div>
            {{-- <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden> --}}

            <div class="col-3 justify-content-center">

                <button type="submit" class="btn btn-warning justify-content-center mb-5 mt-3 ">
                    <a class="text-dark" href="{{route('products.edit',$product->id)}}">Edit</a>

                </button>

            </div>

            <div class="">


            <h3>Comments :</h3>

            @forelse ($product->reviews as $comment)

            <div class="container d-flex align-items-center p-2 mt-3 rounded">

                    <img class="rounded-circle me-3" width="50px" height="50px"  src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="">
                    <p class="text-primary fs-5 me-3">{{$comment->user->name}} </p>

                <p class=" fs-4">: {{' '.$comment->description}}</p>



            </div>
            <div class="border mt-3"></div>

            @empty

            <h3 class="text-warning mt-3 py-3">No Comments</h3>

            @endforelse

        </div>








    </div>







@endsection
