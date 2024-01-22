<?php

namespace App\Http\Controllers\dash\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $products = Product::select('id', 'name', 'price', DB::raw('(select images.url from images where products.id = images.product_id limit 1) as url'))->whereBetween('price', [$min, $max])
            ->orderBy($sortby, $arrow)->paginate(50)->appends([
                    'orderby' => $request->orderby,
                    'arrow' => $request->arrow,
                    'min' => $request->min,
                    'max' => $request->min,
                ]);

        return $products;


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'images.*' => 'required|max:2024',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,

            ]);

            //    dd($request->images);

            if (is_array($request->images)) {
                foreach ($request->images as $img) {

                    $image = new Image();
                    $image->url = Storage::put('product_images', $img);
                    $image->product_id = $product->id;
                    $image->save();
                }
            } elseif ($request->images) {
                $image = new Image();
                $image->url = Storage::put('product_images', $request->images);
                $image->product_id = $product->id;
                $image->save();

            }




            return response()->json([
                'status' => 'new product added',
                'product' => $product,

            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage(),

            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with(['category', 'reviews', 'images', 'user'])->where('id', $id)->get();
            return $product;

        } catch (Exception $e) {
            return response()->json([
                'status' => 'product not found',
                'message' => $e->getMessage(),
            ], 500);
        }



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $chek_img = Image::query()->where('product_id', $id)->get();

            if (count($chek_img) > 0) {
                $request->validate([
                    'name' => 'required',
                    'price' => 'required',
                    'category_id' => 'required',
                    'description' => 'required',
                    'url' => 'max:2024',
                ]);

            } elseif (count($chek_img) < 1) {
                $request->validate([
                    'name' => 'required',
                    'price' => 'required',
                    'category_id' => 'required',
                    'description' => 'required',
                    'images' => 'required|max:2024',
                ], ['images.required' => 'your product should have at least 1 photo'
                ]);

            }
            ;




            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->save();

            if (is_array($request->images)) {

                foreach ($request->images as $img) {

                    $image = new Image();
                    $image->url = Storage::put('product_images', $img);
                    $image->product_id = $id;
                    $image->save();
                }
            }elseif ($request->images) {
                $image = new Image();
                $image->url = Storage::put('product_images', $request->images);
                $image->product_id = $product->id;
                $image->save();

            }
            return response()->json([
                'status' => 'product edited',
                'message' => $product,

            ], 500);


        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),

            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $images = Image::where('product_id',$id)->get();
            // dd($images);
            if ($images) {

                foreach ($images as $image) {
                    if($image->url) Storage::delete($image->url);
                    $image->delete();
                }
            };

            Product::destroy($id);
            return response()->json([
                'status'=>'succsess',
                'message' => 'product deleted',

            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'message' => $e->getMessage(),

            ],500);

        };

    }
}
