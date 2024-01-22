<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Review::with(['product:name,id,price','user:name,id,profile_picture'])->orderBy('created_at','desc')->paginate(20);
        if (Auth::user()->role =='admin') {
            $comments = Review::with(['product'=> function ($query) {
                $query->where('products.user_id', '=', Auth::user()->id);
            },'user:name,id,profile_picture'])->orderBy('created_at','desc')->paginate(20);

        }
        // $comments = Product::with('reviews.user')->get();
        // dd($comments);
        return view('dash-comments.index',['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Review::destroy($id);
        return back();
    }
}
