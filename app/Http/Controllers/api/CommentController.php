<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id'=>Auth::guard('api')->user()->id]);
        $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'user_id' => 'required|numeric|exists:users,id',
            'description' => 'required|max:150'
        ]);
        try {
          $comment =  Review::create($request->except('_token'));
            return response()->json([
                'status'=>'succsess',
                'massage'=>$comment,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'massage'=>$e->getMessage(),
            ]);


        }
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
        $request->validate([
            'description' => 'required|max:150'
        ]);
        try {
          $comment =  Review::find($id);
          if (Auth::guard('api')->user()->id == $comment->user_id) {
          $comment->description =$request->description;
          $comment->save();
            return response()->json([
                'status'=>'succsess',
                'massage'=>$comment,
            ]);
        }else{return response()->json([
            'status'=>'unauthoraized',
        ]);}

        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'massage'=>$e->getMessage(),
            ],500);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Review::find($id);
        if (Auth::guard('api')->user()->id == $comment->user_id) {
            Review::destroy($id);
            return response()->json([
                'status'=>'deleted',
            ]);
        }else{return response()->json([
            'status'=>'unauthoraized',
        ]);}
    }
}
