@extends('layouts.dashmaster')
@section('dash-home', 'Add Category')
@section('name', 'Add Category')
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">
        <form method="POST" class="row" enctype="multipart/form-data" action="{{ route('categories.store') }}"  >
            @csrf


            <div class="col-6 row mb-3">
                <label class="col-3">Category Name :</label>
                <input name="name" value="{{old('name')}}" class="border border-warning rounded col-8" type="text" placeholder="">
                @error('name')
                    <label for='name' class="text-red-800 font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">Category :</label>
                <select class="border border-warning rounded col-8" name="category_id">
                    <option value="" >none</option>
                    @foreach (App\Models\Category::query()->whereNull('category_id')->get() as $cat)
                        <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <p class="text-warning">* don't select if you want to add it as main category</p>
                @error('category_id')
                    <label for='category_id' class="text-red-800 font-bold">{{ $message }}</label>
                @enderror
            </div>



            <div class="col-6 row mb-3">
                <label class="col-3">photo of Category :</label>
                <input name="url" value="{{old('url')}}" class="border border-warning rounded col-8" type="file"  >
                @error('url')
                    <label for='url' class="text-red-800 font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6"></div>


            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

            <div class="col-3 justify-content-center">

                <button type="submit" class="btn btn-warning justify-content-center mb-5 mt-3">Add</button>

            </div>



        </form>
    </div>




@endsection
