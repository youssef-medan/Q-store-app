@extends('layouts.dashmaster')
@section('dash-home', 'Add Product')
@section('name', 'Add Product')
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">
        <form method="POST" class="row" enctype="multipart/form-data" action="{{ route('products.store') }}"  >
            @csrf


            <div class="col-6 row mb-3">
                <label class="col-3">Product Name :</label>
                <input name="name" value="{{old('name')}}" class="border border-warning rounded col-8" type="text" placeholder="">
                @error('name')
                    <label for='name' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">Category :</label>
                <select class="border border-warning rounded col-8" name="category_id">
                    <option hidden >Select</option>
                    @foreach (App\Models\Category::query()->whereNotNull('category_id')->get() as $cat)
                        <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <label for='category_id' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6 row mb-3">
                <label class="col-3">Price :</label>
                <input name="price" value="{{old('price')}}" class="border border-warning rounded col-8" type="number" placeholder="">
                @error('price')
                    <label for='price' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6 row mb-3">
                <label class="col-3">photo of product :</label>
                <input name="url[]" value="{{old('url')}}" class="border border-warning rounded col-8" type="file"  multiple>
                @error('url')
                    <label for='url' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6"></div>


            <div class="col-12 row mb-3">
                <label class="col-3">Description :</label>
                <textarea name="description" aria-valuetext="ssa" class="border border-warning rounded " type="text" cols="70" placeholder="">{{old('description')}}</textarea>
                @error('description')
                    <label for='description' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

            <div class="col-3 justify-content-center">

                <button type="submit" class="btn btn-warning justify-content-center mb-5 mt-3">Add</button>

            </div>



        </form>
    </div>




@endsection
