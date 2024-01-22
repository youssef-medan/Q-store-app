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
            <div class="row">
                <div class="col-md-4 rounded">
                    <div class="profile-img rounded">
                        @if ($profile->profile_picture)
                        <img class="rounded border" src="{{asset('storage/' . $profile->profile_picture)}}"   alt="" />
                        @else
                        <img src="https://static.thenounproject.com/png/354384-200.png" class=""  alt="" />
                        @endif

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$profile->name}}
                        </h5>
                        <br>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-black " id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" id="profile-tab" data-toggle="tab" href="#Address" role="tab"
                                    aria-controls="profile" aria-selected="false">Address</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" onclick="location.href='{{route('profile.edit',Auth::user()->id)}}';" />
                    {{-- <a href="{{route('profile.edit',Auth::user()->id)}}">aa</a> --}}

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {{-- <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="">Website Link</a><br />
                        <a href="">Bootsnipp Profile</a><br />
                        <a href="">Bootply Profile</a>
                        <p>SKILLS</p>
                        <a href="">Web Designer</a><br />
                        <a href="">Web Developer</a><br />
                        <a href="">WordPress</a><br />
                        <a href="">WooCommerce</a><br />
                        <a href="">PHP, .Net</a><br />
                    </div> --}}
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$profile->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$profile->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$profile->mobile}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>your profile created at</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$profile->created_at}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Address" role="tabpanel" aria-labelledby="profile-tab">


                            <div class="row">
                                <div class="col-md-6">
                                    <label>your address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$profile->address}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
