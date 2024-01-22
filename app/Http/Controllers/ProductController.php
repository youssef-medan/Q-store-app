<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class ProductController extends Controller
{



    public function products(Category $category){

            //$id --> category id

            // $products = DB::table('products as pro')->select('*','pro.id as pid')
            // ->leftJoin('images as imgs','pro.id','=','imgs.product_id')
            // ->where('pro.category_id',$id)->get();

            $products = Product::with(['image'])->where('category_id',$category->id)->get();
            // dd($products);
            return view('products',['products'=>$products ]);
            // SELECT * from products as pro JOIN images as imgs ON pro.id = imgs.product_id WHERE pro.category_id = 15;

        

    }
    /**
     * Display a listing of the resource.
     */



     public function allproducts(request $request){

        // $arrow = 'asc';

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
                    $sortby ='products.created_at';
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


            }else {
            $arrow = 'asc';
            $sortby = 'products.created_at';

        }


        if ($request->has('min') || $request->has('max')) {
            $min = $request->min;
            $max = $request->max;
            if ($request->max == 0 || $request->max ==0) {
                $min = Product::query()->min('price');
                $max = Product::query()->max('price');
            }
            if ($request->min > $request->max) {
                return to_route('allproducts')->with('massage','minimum price cannot be more than maximum price ');
            }
        }else {

            $max = Product::query()->max('price');
            $min = Product::query()->min('price');
        }
        if($request->has('search')){
            $products = Product::select('id','name','price',DB::raw('(select images.url from images where products.id = images.product_id limit 1) as url'))->whereBetween('price',[$min,$max])
            ->where('name','LIKE','%'. $request->search .'%')
        ->orderBy($sortby, $arrow)->paginate(16)->appends([

         'search' => $request->search,
         'orderby' => $request->orderby,
         'arrow' => $request->arrow,
         'min' => $request->min,
         'max' => $request->min,
     ]);

        }else{

            $products = Product::select('id','name','price',DB::raw('(select images.url from images where products.id = images.product_id limit 1) as url'))->whereBetween('price',[$min,$max])
            ->orderBy($sortby, $arrow)->paginate(16)->appends([
             'orderby' => $request->orderby,
             'arrow' => $request->arrow,
             'min' => $request->min,
             'max' => $request->min,
         ]);
        }



    //  dd($products);




    //    $products = Product::query()->select('*','products.id as pid')->join('images as imgs','products.id','=','imgs.product_id')
    //    ->whereBetween('price',[$min,$max])
    //    ->orderBy($sortby, $arrow)->paginate(16)->appends([
    //     'orderby' => $request->orderby,
    //     'arrow' => $request->arrow,
    //     'min' => $request->min,
    //     'max' => $request->min,
    // ]);

    // request()->fullUrlWithQuery(['orderby'=>$sortby,'arrow'=>$arrow,'min'=>$min,'max'=>$max]);
       return view('allproducts',['products'=>$products]);
    }

    public function productveiw(Product $product){

        // dd($product);


            // $product = Product::find($id);
            // $product ? '':abort(404 , $message = 'product');
            $imgs = $product->images;
            $img =  $product->images->first();

            $cat =  $product->category;

            $seller =  $product->user->name;



            $comments = Review::with('user')->where('product_id',$product->id)->get();

            // return dd($comments);


            return view('productveiw',['product'=>$product,'imgs'=>$imgs,'img'=>$img,'cat'=>$cat,'seller'=>$seller])->with('comments', $comments);




    }
    public function productcomment(CommentRequest $request){

        $comment = Review::create($request->except('_token'));


        if ($comment) {

            return redirect(url()->previous() ."#$comment->id");
        }else{
            return to_route('weblogin');

        }

       ;
         // return back();
        // try {

        // } catch (Exception $e) {

        // }




    }

    public function commentdelete(string $id){
        Review::destroy($id);
        return back();

    }

    public function commentedit(request $request,string $id){

        $request->validate([
            'description' => 'required|max:150'
        ]);

        $comment = Review::find($id);
        // if (! Gate::allows('update-comment', $comment)) {
        //     abort(403);
        // }

        $this->authorize('update', $comment);


       $comment->description = $request->description;
       $comment->save();
       return back();
    }

    public function index()
    {
        //
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
