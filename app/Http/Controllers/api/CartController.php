<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ShopingCart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::guard('api')->user()->id;
        $user = User::with('shopingCartProducts.image')->find($id);
        $cart = $user->shopingCartProducts;
        return $cart;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id'=>Auth::guard('api')->user()->id]);
        $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
            'product_id' => 'required|numeric|exists:products,id',
        ]);

        try {
            // ShopingCart::create($request->except('_token'));
            $cart = new ShopingCart;
            $cart->user_id = $request->user_id;
            $cart->product_id = $request->product_id;
            $cart->save();
            return response()->json([
                'status'=>'done',
                'product'=>$cart,
            ]);

        } catch (Exception $e) {
            return response()->json([

                'status' => 'failed',
                'message'=> $e->getMessage(),
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ShopingCart::destroy($id);
            return response()->json([
                'status'=>'deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'deleted',
                'message'=> $e->getMessage(),
            ]);

        }
    }
}
