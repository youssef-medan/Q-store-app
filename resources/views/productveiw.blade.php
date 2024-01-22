@extends('layouts.master')
@section('Home', 'Product')

@section('sidebar')
    <style>
        .card {
            border: none
        }

        .product {
            background-color: #eee
        }

        .brand {
            font-size: 13px
        }

        .act-price {
            color: rgb(255, 187, 0);
            font-weight: 700
        }

        .dis-price {
            text-decoration: line-through
        }

        .about {
            font-size: 14px
        }

        .color {
            margin-bottom: 10px
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            padding: 2px 9px;
            border: 2px solid #ff0000;
            display: inline-block;
            color: #ff0000;
            border-radius: 3px;
            text-transform: uppercase
        }

        label.radio input:checked+span {
            border-color: #ff0000;
            background-color: #ff0000;
            color: #fff
        }

        .btn-danger {
            background-color: rgb(255, 187, 0) !important;
            border-color: rgb(255, 187, 0) !important
        }

        .btn-danger:hover {
            background-color: #da0606 !important;
            border-color: #da0606 !important
        }

        .btn-danger:focus {
            box-shadow: none
        }

        .cart i {
            margin-right: 10px
        }
    </style>

    <div class="text-center d-flex justify-content-center">


        @error('description')
            <a id="error"></a>
            <div class="alert alert-danger w-50 text-center">{{ $message }}</div>
        @enderror
    </div>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                @if ($img)

                                <div class="text-center p-4"> <img id="main-image" src="{{ asset('storage/' . $img->url) }}"
                                        width="250" height="300" />
                                </div>
                                @else
                                <div class="text-center p-4"> <img id="main-image" src="https://techsouthafrica.co.za/wp-content/uploads/2023/01/No-Image.jpg"
                                    width="250" height="300" />
                            </div>

                                @endif
                                <div class="thumbnail text-center">
                                    @forelse ($imgs as $img)
                                        <img onclick="change_image(this)" class="images"
                                            src="{{ asset('storage/' . $img->url) }}" width="70">
                                    @empty
                                    @endforelse

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <a
                                            href="{{ url()->previous() }}"
                                            class="ml-1 text-decoration-none text-dark">Back</a> </div> <i
                                        class="fa fa-shopping-cart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3"> <span
                                        class="text-uppercase text-muted brand">{{ $cat->name }}</span>
                                    <h5 class="text-uppercase mt-1">{{ $product->name }}</h5>
                                    <div class="price d-flex flex-row align-items-center"> <span
                                            class="act-price me-2 fs-3">{{ $product->price }} EP</span>
                                        {{-- <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <p class="about">{{ $product->description }}</p>
                                <br>
                                <br>
                                <div>
                                    <h6 class="act-price">seller :</h6>
                                    <h5 class="text-uppercase mt-1 text-bolder">{{ $seller }}</h5>
                                </div>

                                <br>
                                <br>


                                {{-- <div class="sizes mt-5">
                                    <h6 class="text-uppercase">Size</h6> <label class="radio"> <input type="radio"
                                            name="size" value="S" checked> <span>S</span> </label> <label
                                        class="radio"> <input type="radio" name="size" value="M"> <span>M</span>
                                    </label> <label class="radio"> <input type="radio" name="size" value="L">
                                        <span>L</span> </label> <label class="radio"> <input type="radio" name="size"
                                            value="XL"> <span>XL</span> </label> <label class="radio"> <input
                                            type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                                </div> --}}
                                <div class="cart mt-4 align-items-center">

                                    @if (Auth::user())
                                    <form method="POST" action="{{ route('addtocart') }}">
                                        @csrf
                                        <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="number" name="product_id" value="{{ $product->id }}" hidden>
                                        <button type="submit" class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button>

                                    </form>
                                @else


                                <a class="add-to-cart text-dark" href="{{ route('webregister') }}">

                                    <button type="submit" class="btn btn-danger text-uppercase mr-2 px-4">
                                        Add to cart
                                    </button>
                                    </a>


                                @endif


                                    {{-- <i
                                        class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----------comennts------------- --}}

        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-8">
                <div class="headings d-flex justify-content-between align-items-center mb-3">
                    <h5>Comments :</h5>
                    <div onclick="hidecomments()" class="buttons">
                        {{--
                        <span  class="badge bg-white d-flex flex-row align-items-center">
                            <span class="text-primary">Comments</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>

                            </div>
                        </span> --}}

                    </div>

                </div>

                <div class="comments">


                    @forelse ($comments as $comment)
                        <div class="card p-3 mt-2 ">

                            <div class="d-flex justify-content-between align-items-center">

                                <div class="user d-flex flex-row align-items-center">
                                    <a id="{{ $comment->id }}"></a>

                                    @if ($comment->user->profile_picture)
                                        <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" width="40"
                                            height="40" class="user-img rounded-circle m-3">
                                    @else
                                        <img src="https://static.thenounproject.com/png/354384-200.png" width="40"
                                            height="40" class="user-img rounded-circle m-3">
                                    @endif

                                    <span><small class="font-weight-bold text-primary">
                                            @if ($comment->user->name)
                                                {{ $comment->user->name }} :
                                            @else
                                                Anyone :
                                            @endif
                                        </small>
                                        <small class="font-weight-bold fs-5">{{ $comment->description }}</small></span>

                                </div>


                                <small>{{ $comment->created_at }}</small>

                            </div>
                            @auth


                            {{-- @if ($comment->user->id == Auth::user()->id) --}}
                                <div class="action d-flex align-items-baseline">

                                    <a class="text-primary">
                                        <button onclick="edit(event)" class="btn edit_btn" type="submit">
                                            Edit
                                        </button>
                                    </a>

                                    <span class="dots">-</span>

                                    <form action="{{ route('commentdelete', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <a class="text-danger">
                                            <button class="btn" type="submit">
                                                Remove
                                            </button>
                                        </a>
                                    </form>


                                </div>
                                <div hidden>

                                    <form class="edit" action="{{ route('commentedit', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group shadow-textarea mt-5">
                                            <label for="exampleFormControlTextarea6">Edit Your Comment</label>
                                            <textarea class="form-control z-depth-1" name="description" id="exampleFormControlTextarea6" rows="3">{{ $comment->description }}</textarea>
                                            <button class="btn btn-danger rounded mt-3 max-w-25"
                                                type="submit">Update</button>
                                        </div>


                                    </form>
                                    <button onclick="endedit(event)"
                                        class="btn btn-alert rounded mt-3 max-w-25">Cancel</button>

                                </div>
                            {{-- @endif --}}
                            @endauth





                        </div>
                        <hr>

                    @empty
                        <h2>No comments</h2>
                    @endforelse

                    @if (Auth::user())
                        <div class="form-group shadow-textarea mt-5">
                            <form method="POST" action="/addcomment">
                                @csrf
                                <label for="exampleFormControlTextarea6">add your review for this product :</label>
                                <input type="number" name="product_id" value="{{ Request::route('id') }}" hidden>
                                <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>

                                <textarea class="form-control z-depth-1" name="description" id="exampleFormControlTextarea6" rows="3"
                                    placeholder="Write something here..."></textarea>
                                <button class="btn btn-danger rounded mt-3 max-w-25" type="submit">Add</button>

                            </form>

                        </div>
                    @else
                        <div class="form-group shadow-textarea mt-5 d-flex justify-content-center mb-5">



                            <a href="{{ route('weblogin') }}">
                                <button class="btn btn-danger rounded mt-3 max-w-25">
                                    Sign in to add Comment

                                </button>
                            </a>


                        </div>
                    @endif


                </div>






            </div>

        </div>

    </div>
@endsection
<script>
    function change_image(image) {


        var container = document.getElementById("main-image");
        container.src =

            container.src = image.src;
    }
    // function hidecomments(){
    //     let state = 'show'
    //     let commentsdiv = document.getElementsByClassName("comments")[0];
    //     if (state == 'show') {
    //         commentsdiv.setAttribute('hidden','true');
    //         state = 'hide';

    //         // removeAttribute("class")
    //     }
    //     else{
    //         commentsdiv.removeAttribute('hidden');
    //         console.log('as')
    //         state = 'show';


    //     }



    // }

    function edit(event) {
        // let edit_form =document.getElementsByClassName('edit')[0]
        let edit_btn = this.event.target;
        console.log(edit_btn.parentElement.parentElement.nextElementSibling)

        edit_btn.parentElement.parentElement.nextElementSibling.removeAttribute('hidden', 'true')




    }

    function endedit(event) {
        let cancel = this.event.target;
        this.event.target.parentElement.setAttribute('hidden', 'true')
    }



    document.addEventListener("DOMContentLoaded", function(event) {







    });
</script>
