@extends('layouts.master')
@section('Home', 'login')
@section('sidebar')
    <style>
        .form-container {
            background: linear-gradient(#E9374C, rgb(255, 187, 0));
            font-family: 'Roboto', sans-serif;
            font-size: 0;
            padding: 0 15px;
            border: 1px solid rgb(255, 187, 0);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .form-container .form-icon {
            color: #fff;
            font-size: 13px;
            text-align: center;
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 50%;
            padding: 70px 0;
            vertical-align: top;
            display: inline-block;
        }

        .form-container .form-icon i {
            font-size: 124px;
            margin: 0 0 15px;
            display: block;
        }

        .form-container .form-icon .signup a {
            color: #fff;
            text-transform: capitalize;
            transition: all 0.3s ease;
        }

        .form-container .form-icon .signup a:hover {
            text-decoration: underline;
        }

        .form-container .form-horizontal {
            background: rgba(255, 255, 255, 0.99);
            width: 50%;
            padding: 60px 30px;
            margin: -20px 0;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }

        .form-container .title {
            color: #454545;
            font-size: 23px;
            font-weight: 900;
            text-align: center;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            margin: 0 0 30px 0;
        }

        .form-horizontal .form-group {
            background-color: rgba(255, 255, 255, 0.15);
            margin: 0 0 15px;
            border: 1px solid #b5b5b5;
            border-radius: 20px;
        }

        .form-horizontal .input-icon {
            color: #b5b5b5;
            font-size: 15px;
            text-align: center;
            line-height: 38px;
            height: 35px;
            width: 40px;
            vertical-align: top;
            display: inline-block;
        }

        .form-horizontal .form-control {
            color: #b5b5b5;
            background-color: transparent;
            font-size: 14px;
            letter-spacing: 1px;
            width: calc(100% - 55px);
            height: 33px;
            padding: 2px 10px 0 0;
            box-shadow: none;
            border: none;
            border-radius: 0;
            display: inline-block;
            transition: all 0.3s;
        }

        .form-horizontal .form-control:focus {
            box-shadow: none;
            border: none;
        }

        .form-horizontal .form-control::placeholder {
            color: #b5b5b5;
            font-size: 13px;
            text-transform: capitalize;
        }

        .form-horizontal .btn {
            color: rgba(255, 255, 255, 0.8);
            background: rgb(170, 68, 0);
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            margin: 0 0 10px 0;
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .form-horizontal .btn:hover,
        .form-horizontal .btn:focus {
            color: #fff;
            background-color: rgb(255, 187, 0);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .form-horizontal .forgot-pass {
            font-size: 12px;
            text-align: center;
            display: block;
        }

        .form-horizontal .forgot-pass a {
            color: #999;
            transition: all 0.3s ease;
        }

        .form-horizontal .forgot-pass a:hover {
            color: #777;
            text-decoration: underline;
        }

        @media only screen and (max-width:576px) {
            .form-container {
                padding-bottom: 15px;
            }

            .form-container .form-icon {
                width: 100%;
                padding: 20px 0;
            }

            .form-container .form-horizontal {
                width: 100%;
                margin: 0;
            }
        }
    </style>




    <div class="form-bg ">

        <div class="container">
            <div class="row h-100 d-flex align-items-center justify-content-center ">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
                    <div class="alert w-100  fs-3 text-danger  max-w-full flex-initial">
                        {{ session('status') }}
                    </div>
                    @error('email')
                        <div class="alert alert-danger w-50">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="alert alert-danger w-50">{{ $message }}</div>
                    @enderror
                    <div class="form-container">
                        <div class="form-icon">
                            <i class="fa fa-user-circle"></i>
                            <span class="signup"><a href="{{ route('webregister') }}">Don't have account?
                                    Signup</a></span>
                        </div>
                        <form method="POST" action="login" class="form-horizontal">
                            @csrf
                            <h3 class="title">Member Login</h3>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <button class="btn signin" type="submit">Login</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    </div>
@endsection
