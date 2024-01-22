<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopingCart;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function home(request $request){
        // $sql = "select * from categories as cat join category_images as cimg on cat.id = cimg.category_id where cat.category_id is null;";
        // $cats = Category::where("category_id","=","null");

        // // $cats = Category::all()->where('category_id','=','');
        // $cats = DB::select($sql);

        if ($request->has('search')) {
            $request->validate([
                'search' => 'min:3'
            ]);
            $prouducts_search = Product::select('id','name','price',DB::raw('(select images.url from images where products.id = images.product_id limit 1) as url'))
            ->where('name','LIKE','%'. $request->search .'%')->orWhere('price','LIKE','%'. $request->search .'%')->paginate(20)->appends([
                    'search' => $request->search,

                 ]);
            $cartcount = ShopingCart::query()->select('id')->get();
            // $prouducts_search = DB::table('products as pro')->select('*')
            // ->leftJoin('images as imgs','pro.id','=','imgs.product_id')
            // ->where('pro.name','LIKE','%'. $request->search .'%')->orWhere('pro.price','LIKE','%'. $request->search .'%')->paginate(20)->appends([
            //     'search' => $request->search,

            // ]);
            return view('/welcome',["prouducts_search"=>$prouducts_search ,'cartcount'=>$cartcount]);

        }else {
            $cartcount = ShopingCart::query()->select('id')->get();

            $cats = DB::table('categories as cat')->select('cat.id as id','cat.name as name','cimg.url as url')
            ->leftJoin("category_images as cimg","cat.id","=","cimg.category_id")
            ->whereNull('cat.category_id')->paginate(20);

            return view('/welcome',["cats"=>$cats ,'cartcount'=>$cartcount]);
        }

    }
}
