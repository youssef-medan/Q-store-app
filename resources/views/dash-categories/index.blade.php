@extends('layouts.dashmaster')
@section('dash-home', 'Categories')
@section('name', 'Categories')
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





        .hiddenRow {
            padding: 0 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


    <div class="">
        @if (session()->has('status'))
            <div class="flex-initial max-w-full text-xl font-normal fs-3 text-warning">
                {{ session('status') }}</div>
        @endif

        <div class="d-flex justify-content-center">

            <button class="btn btn-warning rounded mb-5 ">
                <a class="text-dark fw-bold" href="{{ route('categories.create') }}">Add New Category</a>

            </button>

        </div>










        {{-- {{ $categories->links() }} --}}


        <table class="table  table-striped table-hover table align-middle">
            <thead class="text-warning">
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th class=" "scope="col">View</th>

                    <th class="" scope="col">Created_at</th>
                    @if (Auth::user()->role == 'superadmin')
                        <th scope="col">Options</th>
                    @endif
                </tr>
            </thead>
            <tbody class="">
                @forelse ($categories as $category )
                    <tr>


                        <td class="fs-6 text-warning">{{ $loop->iteration }}</td>
                        <td class="fs-6">{{ $category->name }}</td>




                        <td class="w-50">
                            @if ($category->category_image)
                                {{-- <img class="w-25 d-inline" src="{{ $category->category_image->url }}" alt=""> --}}
                                <img  height="150" width="250" src="{{ asset('storage/' . $category->category_image->url) }}"
                                    alt="">
                            @else
                            @endif

                        </td>


                        <td class="fs-6">{{ $category->created_at }}</td>
                        @if (Auth::user()->role == 'superadmin')
                            <td>
                                <div class="d-flex flex-column align-items-center ">

                                    <div>
                                        <form action="">
                                            <a href="{{ route('categories.edit', $category->id) }}"> <i
                                                    class="fa-solid fa-pen-to-square"></i></a>

                                        </form>

                                    </div>
                                    <div>
                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn" type="submit"> <i class="fa-solid fa-trash"
                                                    style="color: #e02f18;"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        @endif


            <tbody>
                <tr class="fs-6">
                    <td colspan="5">

                        <div class="card">
                            <div class="accordion-item">
                                <h2 class="accordion-header bg-warning" id="headingOne">
                                    <button class="btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                        aria-controls="collapse{{ $loop->iteration }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </h2>

                                <div id="collapse{{ $loop->iteration }}" class="collapse w-100"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body w-100">
                                        <table class="table  table-striped table-hover table align-middle">
                                            <thead>
                                                <tr class="">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th class=" "scope="col">View</th>

                                                    <th class="" scope="col">Created_at</th>
                                                    @if (Auth::user()->role == 'superadmin')
                                                        <th scope="col">Options</th>
                                                    @endif
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @forelse ($category->sub_categories as $sub)
                                                    <tr class="">
                                                        <td class="fs-6 text-warning">{{ $loop->iteration }}</td>
                                                        <td>{{ $sub->name }}</td>
                                                        <td>
                                                            @if ($sub->category_image->url)
                                                                <img class="w-25 px-5 d-inline"
                                                                    src="{{ asset('storage/' . $sub->category_image->url) }}"
                                                                    alt="">
                                                            @else
                                                                <img class="w-25 d-inline"
                                                                    src="{{ $sub->category_image->url }}" alt="">
                                                            @endif

                                                        </td>
                                                        <td>{{ $sub->created_at }}</td>
                                                        @if (Auth::user()->role == 'superadmin')
                                                            <td>
                                                                <div class="d-flex flex-column align-items-center ">

                                                                    <div>
                                                                        <form action="">
                                                                            <a
                                                                                href="{{ route('categories.edit', $sub->id) }}">
                                                                                <i
                                                                                    class="fa-solid fa-pen-to-square"></i></a>

                                                                        </form>

                                                                    </div>
                                                                    <div>
                                                                        <form method="POST"
                                                                            action="{{ route('categories.destroy', $sub->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn" type="submit"> <i
                                                                                    class="fa-solid fa-trash"
                                                                                    style="color: #e02f18;"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </td>


                </tr>
            </tbody>




        @empty
            <td class="fs-1" colspan="6">
                no data

            </td>


            @endforelse


            </tr>

            </tbody>
        </table>
        {{-- {{ $categories->links() }} --}}

    </div>
@endsection
