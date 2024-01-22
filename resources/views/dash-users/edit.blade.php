@extends('layouts.dashmaster')
@section('dash-home', 'Edit user')
@section('name', 'Edit user : ' . $user->name)
<br>
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/input.css') }}" />

    <div class="mt-5">
        <form method="POST" class="row" enctype="multipart/form-data" action="{{ route("users.update", $user->id) }}">
            @csrf
            @method('PATCH')
            <div class=" mb-3 row border">
                <label class="">photo of user :</label>
                @if ($user->profile_picture)
                    <div class="d-flex col-4 py-4">

                        <img class="rounded" style="width: 400px;" src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="">

                    </div>
                @else
                    <p>this user has no photo, please add</p>
                @endif
            </div>


            <div class="col-6 row mb-3">
                <label class="col-3">user Name :</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('name')
                    <label for='name' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>


            <div class="col-6 row mb-3">
                <label class="col-3">Email :</label>
                <input name="email" value="{{ old('email', $user->email) }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('email')
                    <label for='email' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-6 row mb-3">
                <label class="col-3">Mobile :</label>
                <input name="mobile" value="{{ old('mobile', $user->mobile) }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('mobile')
                    <label for='mobile' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">password :</label>
                <input name="password" value=""
                    class="border border-warning rounded col-8" type="text" placeholder="">
                @error('password')
                    <label for='password' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6 row mb-3">
                <label class="col-3">Address :</label>
                <input name="address" value="{{ old('address', $user->address) }}" class="border border-warning rounded col-8"
                    type="text" placeholder="">
                @error('address')
                    <label for='address' class="text-danger font-bold">{{ $message }}</label>
                @enderror
            </div>

            @if (Auth::guard('web')->user()->role == 'superadmin')

            <div class="col-6 row mb-3">

                    <div class="form-check">
                        <input class="form-check-input"  type="radio" name="role" value="user" id="user"{{$user->role == 'user' ? 'checked':''}} >
                        <label class="form-check-label" for="user">
                            User
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" name="role" value="admin" id="admin" {{$user->role == 'admin' ? 'checked':''}}>
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" name="role" value="superadmin" id="superadmin" {{$user->role == 'superadmin' ? 'checked':''}}>
                        <label class="form-check-label" for="superadmin">
                            Super Admin
                        </label>
                    </div>

            </div>
            @endif







            <div class="col-6 row mb-3">
                <label class="col-3">cahnge photo :</label>
                <input name="profile_picture" value="{{ old('url') }}" class="border border-warning rounded col-8"
                    type="file">
                @error('profile_picture')
                    <label for='profile_picture' class="text-danger font-bold">{{ $message }}</label>
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
