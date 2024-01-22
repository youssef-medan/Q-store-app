@extends('layouts.dashmaster')
@section('dash-home', 'Comments')
@section('name', Auth::user()->role == 'admin' ? 'Comments on your products' : 'Comments')
<br>
@section('body')


    <div class="container justify-content-center ">


        <div class=" text-center mb-5">
            <h4 class="">Latest Comments</h4>
        </div>
        {{ $comments->links() }}
        <div class="comment-widgets mt-5 mb-5">
            <!-- Comment Row -->

            @forelse ($comments as $comment)
                @if ($comment->product)
                    <div class="d-flex flex-row comment-row m-t-0 border border-3 mt-2 rounded-pill px-5">
                        <div class="p-2">
                            <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="user" height="50"
                                width="50" class="rounded-circle">
                        </div>
                        <div class="comment-text w-100 mt-2">
                            <h6 class="font-medium text-warning fw-bolder">{{ $comment->user->name }}</h6> <span
                                class="m-b-15 d-block">{{ $comment->description }}</span>
                            <div class="comment-footer"> <span
                                    class="text-muted float-right">{{ $comment->created_at }}</span>

                            </div>
                        </div>
                        <div class=" w-100 text-center">
                            <p class="mt-1 fw-bolder">{{ $comment->product->name }}</p>
                            <p>{{ $comment->product->price . ' ' . 'LE' }}</p>
                            <button class="btn btn-sm btn-warning mb-1"><a class="text-dark"
                                    href="{{ route('products.show', $comment->product->id) }}">Veiw
                                    Product</a></button>

                        </div>
                        @if (Auth::user()->role == 'superadmin')
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                    </form>
                @endif

                {{-- @else
                    <p class="text-center fs-3 text-warning">You Don,t Have Any Comments</p> --}}
            @endif
        @empty
            @endforelse
        </div>

        {{ $comments->links() }}


    </div>

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/css/comments.css') }}" /> --}}
@endsection
