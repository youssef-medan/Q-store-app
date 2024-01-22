<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\dash\ProductCreateRequest;
use App\Http\Requests\dash\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
       $products = Product::with(['images'])->paginate(20);
       if (Auth::user()->role == 'admin') {
        $products = Product::with(['images'])->where('user_id',Auth::guard('web')->user()->id)->paginate(20);
    }

    if ($request->has('search')) {
        $products = Product::with(['images'])->where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')
        ->paginate(15)->appends([
                'search' => $request->search,

            ]);

        if (Auth::user()->role == 'admin') {
            $products = Product::with(['images'])->where('user_id',Auth::guard('web')->user()->id)->where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')->With
            ->paginate(15)->appends([
                    'search' => $request->search,

                ]);
        }



    }
    //    DD($products);
        return view('dash-products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash-products.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {

       $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'user_id' => $request->user_id,

       ]);



    foreach ($request->file('url') as $img) {

        $image = new Image();
        $image->url = Storage::put('product_images',$img);
        $image->product_id = $product->id;
        $image->save();
    }


       return to_route('products.index')->with('status','new product added');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $product = Product::with(['images','reviews.user'])->find($id);
        // dd($product);
        return view('dash-products.show',['product'=>$product]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['images'])->find($id);
        return view('dash-products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {

        $chek_img = Image::query()->where('product_id',$id)->get();
        // dd(count($chek_img));
        if (count($chek_img) > 0) {
            $request->validate([
                'url'=> 'max:2024',
            ]);

        }elseif(count($chek_img) < 1){
            $request->validate([

                'url'=> 'required|max:2024',
            ], ['url.required'=>'your product should have at least 1 photo'
            ]);

        };




        $product = Product::findOrFail($id);
        $product->name =  $request->name;
        $product->price =  $request->price;
        $product->category_id =  $request->category_id;
        $product->description =  $request->description;
        $product->save();

        if ($request->file('url')) {

            foreach ($request->file('url') as $img) {

                $image = new Image();
                $image->url = Storage::put('product_images',$img);
                $image->product_id = $id;
                $image->save();
            }
        }


        return to_route('products.index')->with('status','Product Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $images = Image::where('product_id',$id)->get();
        // dd($images);
        if ($images) {

            foreach ($images as $image) {
                if($image->url) Storage::delete($image->url);
                $image->delete();
            }
        }

        Product::destroy($id);
        return back();


    }
}
