@extends('layouts.dashmaster')
@section('dash-home', 'Edit Category')
@section('name', 'Edit Category : ' . $category->name)
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">
        <form method="POST" class="row" enctype="multipart/form-data" action="{{ route('categories.update',$category->id) }}">
            @csrf
            @method('PATCH')
            <div class=" mb-3 row border">
                <label class="">photo of category :</label>
                @if ($category->category_image)

                    <div class="d-flex col-4 py-4">

                        <img class="rounded" style="width: 400px;" src="{{ asset('storage/' . $category->category_image->url) }}" alt="">

                    </div>

                @else
                    <p>this category has no photo, please add</p>
                @endif
            </div>


            <div class="col-6 row mb-3">
                <label class="col-3">category Name :</label>
                <input name="name" value="{{ old('name', $category->name) }}" class="border border-warning rounded col-8"
                type="text" placeholder="">
                @error('name')
                <label for='name' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>



                    <div class="col-6 row mb-3">
                        <label class="col-3">Category :</label>
                        <select class="border border-warning rounded col-8" name="category_id">
                            @if ($category->main_category)
                            <option value="{{$category->main_category->id}}">{{$category->main_category->name}}</option>
                            <option value="" >Main Category</option>

                            @foreach (App\Models\Category::query()->whereNull('category_id')->get() as $cat)
                            <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                            @endforeach
                            @else
                            <option value="" >Main Category</option>

                            @foreach (App\Models\Category::query()->whereNull('category_id')->get() as $cat)
                            <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                            @endforeach


                            @endif
                        </select>
                        <p class="text-warning"></p>
                        @error('category_id')
                            <label for='category_id' class="text-red-800 font-bold">{{ $message }}</label>
                        @enderror
                    </div>



                    <div class="col-6 row mb-3">
                        <label class="col-3">cahnge photo :</label>
                        <input name="url" value="{{ old('url') }}" class="border border-warning rounded col-8"
                            type="file" >
                        @error('url')
                            <label for='url' class="text-danger font-bold">{{ $message }}</label>
                        @enderror
                    </div>

            <div class="col-6"></div>



            {{-- <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden> --}}

            <div class="col-3 justify-content-center">

                <button type="submit" class="btn btn-warning justify-content-center mb-5 mt-3">Edit</button>

            </div>



        </form>
    </div>




@endsection
