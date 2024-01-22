<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['sub_categories.category_image','category_image'])->whereNull('category_id')->get();
        // dd($categories[0]->sub_categories[0]);
        return view('dash-categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'url'=> 'required|max:2024',

        ]);
       $category = Category::create([
        'name' => $request->name,
        'category_id' => $request->category_id,

       ]);





        $image = new CategoryImage();
        $image->url = Storage::put('category_images',$request->file('url'));
        $image->category_id = $category->id;
        $image->save();



       return to_route('categories.index')->with('status','new Category added');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::with(['category_image','main_category'])->findOrFail($id);
        // dd($category);
        return view('dash-categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> 'required',

            'url'=> 'max:2024',
        ]);

        $category = Category::findOrFail($id);
        $category->name =  $request->name;
        $category->category_id =  $request->category_id;
        $category->save();

        $category_image = CategoryImage::query()->where('category_id',$id)->first();
        // dd($category_image->url);

        if ($category_image->url && $request->file('url')) {
            Storage::delete($category_image->url);
            $category_image->url = Storage::put('category_images', $request->file('url'));

        }elseif ($request->file('url')) {
            $category_image->url = Storage::put('category_images', $request->file('url'));
        }
        $category_image->save();
        return to_route('categories.index')->with('status','Category Edited');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $image = CategoryImage::where('category_id',$id)->first();
        // dd($images);
        if ($image) {


                if($image->url) Storage::delete($image->url);
                $image->delete();

        }

        Category::destroy($id);
        return to_route('categories.index')->with('status','Category Deleted');

    }
}
