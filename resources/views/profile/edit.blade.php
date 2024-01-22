@extends('layouts.master')
@section('Home', 'Profile')
<style>
    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid rgb(255, 187, 0);
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: rgb(255, 187, 0);
    }
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


@section('sidebar')

    <div class="container emp-profile">
        <form enctype="multipart/form-data" method="POST" action="{{route('profile.update',Auth::user()->id)}}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-4">
                    {{-- <img src="{{asset('public/storage/profiles_pictures/' . $profile->profile_picture)}}"  alt="" /> --}}

                    <div class="profile-img">
                        @if ($profile->profile_picture)
                        <img class="rounded border" src="{{asset('storage/' . $profile->profile_picture)}}"  alt="" />
                        @else
                        <img class="rounded" src="https://static.thenounproject.com/png/354384-200.png"   alt="" />
                        @endif

                        <div class="file btn btn-lg btn-primary">
                            Change Photo
                            <input type="file" name="profile_picture" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$profile->name}}
                        </h5>
                        <br>


                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4"> </div>
                <div class="col-md-8">


                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p><input type="text" name="name" value="{{old('name',$profile->name)}}"></p>
                                    @error('name')
                                    <label for='name'
                                        class="text-red-800 font-bold">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p><input type="text" name="email" value="{{old('email',$profile->email)}}"></p>
                                    @error('email')
                                    <label for='email'
                                        class="text-red-800 font-bold">{{ $message }}</label>
                                  @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p><input type="text" name="mobile" value="{{old('mobile',$profile->mobile)}}"></p>
                                    @error('mobile')
                                    <label for='mobile'
                                        class="text-red-800 font-bold">{{ $message }}</label>
                                @enderror
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <label>your address</label>
                                </div>
                                <div class="col-md-6">
                                    <textarea class="form-control z-depth-1"  rows="3" type="text" name="address">
                                    {{old('address',$profile->address)}}
                                    </textarea>

                                    @error('address')
                                    <label for='address'
                                        class="text-red-800 font-bold">{{ $message }}</label>
                                @enderror
                                </div>
                            </div>
                            <div class="row">

                                <button type="submit" class="btn btn-warning col-2">save</button>
                            </div>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('profile.destroy',Auth::user()->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Remove My Account</button>

        </form>
    </div>




@endsection
