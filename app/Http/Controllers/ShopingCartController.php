<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailQueueJob;
use App\Mail\CartMail;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ShopingCart;
use App\Models\User;
use Illuminate\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShopingCartController extends Controller
{

    public function shopcart()
    {
        if (auth()->check()) {

            $id = Auth::user()->id;
            $user = User::find($id);
            // $user->products()->withPivot()->lists();
            // $shopcart = User::with(['products'])->where('id',$id)->get();
            // $cart = User::with(['products.images'])->where('id',$id)->get();

            // $cart = ShopingCart::query()
            // ->select('shoping_carts.id as id','u.name as seller','pro.id as pid','pro.name as name','pro.description as des','pro.price as price','img.url as url','cat.name as cat')
            // ->join('products as pro','shoping_carts.product_id','=','pro.id')
            // ->join('categories as cat','pro.category_id','=','cat.id')
            // ->join('users as u','shoping_carts.user_id','=','u.id')
            // ->leftJoin('images as img','pro.id','=','img.product_id')
            // ->where('u.id',$id)->get();

            // $cart = User::with(['products'])->where('id',$id)->get();


            // $cart = Product::with(['user' => function ($q) use ($id) {
            //     $q->where("users.id", "=", $id);
            // }, 'images'])->get();


            // $prodcut_id = ShopingCart::query()->select('product_id')->where('user_id',$id)->get();
            // $products =[];
            // foreach ($prodcut_id as $pid) {
            //     $products[] = Product::query()->where('id',$pid->product_id)->get();

            // }
            // dd($cart);

            // dd(User::with(['shopingCartProducts'])->find($id));
            $user = User::with(['shopingCartProducts.image'])->find($id);
            $cart = $user->shopingCartProducts;
            // dd($cart);




            return view('shopingcart', ['cart' => $cart]);
            // return DD($cart);
        } else {
            return to_route('webregister')->with('status', 'register now to add products to your cart');

        }
    }

    public function addtocart(request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
            'product_id' => 'required|numeric|exists:products,id',
        ]);

        try {

            $shop_cart = ShopingCart::where('product_id',$request->product_id)->where('user_id',$request->user_id)->first();
            // dd($shop_cart);
            if($shop_cart){
                $shop_cart->quantity = $shop_cart->quantity+1;
                $shop_cart->save();
                return redirect(url()->previous() ."#$request->product_id");

            }else{

            // ShopingCart::create($request->except('_token'));
            $cart = new ShopingCart;
            $cart->user_id = $request->user_id;
            $cart->product_id = $request->product_id;
            $cart->save();
            $product = Product::with('category')->find($cart->product_id);
            $name = $product->name;
            $category = $product->category->name;
            // dispatch(new SendEmailQueueJob($name,$category));
            Mail::to(Auth()->user()->email,auth()->user()->name)->later(now()->addSeconds(10),new CartMail($name,$category));


            return redirect(url()->previous() ."#$request->product_id");
            }


        } catch (\Throwable $th) {
            //throw $th;
        }



    }
    public function shopingcartdelete(string $id)
    {
        ShopingCart::destroy($id);
        return redirect(url()->previous() ."#$id");

    }

    public function shopingcartplus(string $id){
        $cart_product = ShopingCart::find($id);
        $cart_product->quantity = $cart_product->quantity +1;
        $cart_product->save();
        return redirect(url()->previous() ."#$id");




    }
    public function shopingcartminus(string $id){
        $cart_product = ShopingCart::find($id);
        $cart_product->quantity = $cart_product->quantity -1;
        $cart_product->save();

        if ($cart_product->quantity == 0) {
            ShopingCart::destroy($id);
        }
        return redirect(url()->previous() ."#$id");



    }


}
