@extends('layouts.dashmaster')
@section('dash-home', 'Add user')
@section('name', 'Add user')
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">
        <form method="POST" class="row" enctype="multipart/form-data" action="{{ route('users.store') }}">
            @csrf
            <div class=" mb-3 row  ">
                <div class="col-6 row mb-3">
                    <label class="col-3 align-self-center">Add profile :</label>
                    <input name="profile_picture" value="{{ old('url') }}"
                        class="border border-warning rounded bg-warning w-50" type="file">
                    @error('profile_picture')
                        <label for='profile_picture' class="text-danger font-bold">{{ $message }}</label>
                    @enderror
                </div>

            </div>

            {{-- <div>
                <label for="file-upload" class="custom-file-upload fs-3 ">
                    Add profile picture <i class="fa-solid fa-image"></i>
                </label>
                <input name="profile_picture" value="{{ old('url') }}" id="file-upload" type="file" hidden />
                @error('profile_picture')
                    <label for='profile_picture' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div> --}}



            <div class="col-6 row mb-3">
                <label class="col-3">User Name :</label>
                <input name="name" value="{{ old('name') }}" class="border border-warning rounded col-8" type="text"
                    placeholder="">
                @error('name')
                    <label for='name' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>


            <div class="col-6 row mb-3">
                <label class="col-3">Email :</label>
                <input name="email" value="{{ old('email') }}" class="border border-warning rounded col-8" type="text"
                    placeholder="">
                @error('email')
                    <label for='email' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6 row mb-3">
                <label class="col-3">Mobile :</label>
                <input name="mobile" value="{{ old('mobile') }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('mobile')
                    <label for='mobile' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">password :</label>
                <input name="password" value="" class="border border-warning rounded col-8" type="text"
                    placeholder="">
                @error('password')
                    <label for='password' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">Address :</label>
                <input name="address" value="{{ old('address') }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('address')
                    <label for='address' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="user" id="user">
                    <label class="form-check-label" for="user">
                        User
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="admin" id="admin">
                    <label class="form-check-label" for="admin">
                        Admin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="superadmin" id="superadmin">
                    <label class="form-check-label" for="superadmin">
                        Super Admin
                    </label>
                </div>

            </div>









            <div class="col-6"></div>



            {{-- <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden> --}}

            <div class="d-flex justify-content-end ">

                <button type="submit" class="btn btn-warning justify-content-center mb-5 mt-3">Create</button>

            </div>



        </form>
    </div>




@endsection
