<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function category_veiw(Category $category)
    {


            $categoryProduct = Category::with(['category_image','products' => function ($q) {
                $q->paginate(8);
             }])->where('category_id',$category->id)->get();
            // dd($categoryProduct);



                    // $category = Category::query()->where("id", $id)->first();
                    // $subcats = Category::query()->where("category_id", $id)->first();



                    // $subcats = DB::table('categories as cat')->select('cat.name as name','cimg.url as url','cat.id as id')
                    // ->leftJoin("category_images as cimg","cat.id","=","cimg.category_id")
                    // ->where('cat.category_id','=',$id)->get();

                    // $cat_product = DB::table('product')->select('*')->where('category_id ','=', $subcats->id->first())->get();




                    return view('categoryveiw',compact('category') )->with('categoryProduct',$categoryProduct);


    }




}
