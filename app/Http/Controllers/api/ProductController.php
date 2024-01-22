<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShowResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        if ($request->has('orderby')) {


            switch ($request->orderby) {
                case 'atoz':
                    $sortby = 'products.name';
                    break;
                case 'lastest':
                    $sortby = 'products.created_at';
                    break;
                case 'price':
                    $sortby = 'products.price';
                    break;


                default:
                    $sortby = 'products.created_at';
                    $arrow = 'asc';

                    break;
            }

            switch ($request->arrow) {
                case 'asc':
                    $arrow = 'asc';

                    break;
                case 'desc':
                    $arrow = 'desc';

                    break;

                default:
                    $arrow = 'asc';
                    break;
            }


        } else {
            $arrow = 'asc';
            $sortby = 'products.created_at';

        }


        if ($request->has('min') || $request->has('max')) {
            $min = $request->min;
            $max = $request->max;
            if ($request->max == 0 || $request->max == 0) {
                $min = Product::query()->min('price');
                $max = Product::query()->max('price');
            }
            if ($request->min > $request->max) {
                return to_route('allproducts')->with('massage', 'minimum price cannot be more than maximum price ');
            }
        } else {

            $max = Product::query()->max('price');
            $min = Product::query()->min('price');
        }


        $products = Product::query()->select('*', 'products.id as pid')->join('images as imgs', 'products.id', '=', 'imgs.product_id')
            ->whereBetween('price', [$min, $max])
            ->orderBy($sortby, $arrow)->paginate(16)->appends([
                    'orderby' => $request->orderby,
                    'arrow' => $request->arrow,
                    'min' => $request->min,
                    'max' => $request->min,
                ]);

        return ProductResource::collection($products) ;
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
        if (Product::find($id)) {

            // $product = Product::find($id)->join('catrgories','product_id','=','catrgories.id');

        //    $load = Product::with('category');
        //     $imgs = $product->images('url')->toarray();
        //     // $img =  $product->images->url->first();
        //     $cat =  $product->category;
        //     $seller =  $product->user;
        //     $comments = $product->reviews;

        $product = Product::with(['category','reviews','images','user'])->where('id',$id)->get();

            $productall = Category::query()
            ->select('pro.id as id','pro.name as name','pro.description as description','pro.price as price','categories.name as category','seller.name as seller','pro.created_at as created_at')
            ->join('products as pro','categories.id','=','pro.category_id')
            ->join('users as seller','pro.user_id','=','seller.id')
            ->join('images as imgs','pro.id','=','imgs.product_id')
            ->join('reviews as comments','pro.id','=','comments.product_id')
            ->where('pro.id',$id)->get();


            // return view('productveiw',['product'=>$product,'imgs'=>$imgs,'img'=>$img,'cat'=>$cat,'seller'=>$seller])->with('comments', $comments);
          return ProductShowResource::collection($product);
        //   return ProductShowResource::collection($productall);

        }else {
            return back();
        }
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
        //
    }
}
