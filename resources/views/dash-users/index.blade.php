@extends('layouts.dashmaster')
@section('dash-home', 'users')
@section('name', 'users')
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
                <a class="text-dark fw-bold" href="{{ route('users.create') }}">Add New user</a>

            </button>

        </div>



        <form  action="{{ route('users.index') }}">





            <div class="d-flex justify-content-center ">

                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control input-text" name="search" placeholder="Search users...."
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button  class="btn btn-outline-warning btn-lg" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>

            </div>
        </form>


        <div class="btn-group ">

            <form action="{{ route('users.index') }}">
                <input name="role" value="user" hidden>
                <button class="btn border border-warning text-warning {{url()->full()=='http://127.0.0.1:8000/dashboard/users'||url()->full()=='http://127.0.0.1:8000/dashboard/users?role=user'?'bg-warning text-light':''}}">Users</button>
            </form>
            <form action="{{ route('users.index') }}">
                <input name="role" value="admin" hidden>
                <button class="btn border border-warning text-warning {{url()->full()=='http://127.0.0.1:8000/dashboard/users?role=admin'?'bg-warning text-light':''}}">Admins</button>
            </form>
            <form action="{{ route('users.index') }}">
                <input name="role" value="superadmin" hidden>
                <button class="btn border border-warning text-warning {{url()->full()=='http://127.0.0.1:8000/dashboard/users?role=superadmin'?'bg-warning text-light':''}}">Super Admins</button>
            </form>
        </div>









        <table class="table  table-striped table-hover table align-middle border w-100">

            <thead class="text-warning">
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Profile-picture</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th class="" scope="col">Role</th>
                    <th class="" scope="col">Created_at</th>
                    @if (Auth::user()->role == 'superadmin')
                    <th scope="col">Options</th>
                @endif
                </tr>
            </thead>
            <tbody class="">
                @forelse ($users as  $user )
                    <tr a class="">



                        <td class="fs-6 text-warning">{{ $loop->iteration }}</td>



                        <td class="fs-6">
                            @if ($user->profile_picture)

                            <img class="header_img " src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="">

                            @else
                            <img class="header_img "
                            src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                            alt="">
                            @endif

                        </td>

                        <td class="fs-6"><a href="{{route("users.show",$user->id)}}">{{ $user->name }}</a></td>
                        <td class="fs-6">{{ $user->email }}</td>
                        <td class="fs-6">{{ $user->mobile }}</td>
                        <td class="fs-6">{{ $user->role }}</td>

                        <td class="fs-6">{{ $user->created_at }}</td>
                        @if (Auth::user()->role == 'superadmin')

                        <td>
                            <div class="d-flex flex-column align-items-center ">

                                <div>
                                    <form action="">
                                    <a href="{{ route('users.edit', $user->id) }}"> <i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                        </form>

                                </div>
                                <div>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit"> <i class="fa-solid fa-trash"
                                                style="color: #e02f18;"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endif

                    @empty

                        no data

                @endforelse


                </tr>
            </tbody>
        </table>
        {{ $users->links() }}

    </div>
@endsection
