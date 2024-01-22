<?php

namespace App\Http\Controllers\dash\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_comments = Review::with(['product:name,id,price','user:name,id,profile_picture'])->orderBy('created_at','desc')->get();
        // if (Auth::guard('api')->user()->role =='admin') {
        //     $comments = Review::with(['product'=> function ($query) {
        //         $query->where('products.user_id', '=', Auth::guard('api')->user()->id);
        //     },'user:name,id,profile_picture'])->orderBy('created_at','desc')->get();

        // }

        $product_comments = Product::with('reviews.user:id,name,profile_picture')->whereHas('reviews')->get(['id','name','price']);

        if (Auth::guard('api')->user()->role =='admin') {

            $product_comments = Product::with('reviews.user:id,name,profile_picture')->where('user_id',Auth::guard('api')->user()->id)->whereHas('reviews')->get(['id','name','price']);
        }
        // dd($com);
        return $product_comments;
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
        try {
            Review::destroy($id);
            return response()->json([
                'status'=>'deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ],500);
        }
    }
}
