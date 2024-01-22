<?php

namespace App\Http\Controllers\dash\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['category_image:id,url,category_id', 'sub_categories.category_image:id,url,category_id'])->whereNull('category_id')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|max:2024',
        ]);
        try {
            $category = Category::create([
                'name' => $request->name,
                'category_id' => $request->category_id,

            ]);





            $image = new CategoryImage();
            $image->url = Storage::put('category_images', $request->image);
            $image->category_id = $category->id;
            $image->save();
            return response()->json([
                'status' => 'new category added',
                'massege' => $category,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massege' => $e->getMessage(),
            ], 500);
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
            'name' => 'required',
            'image' => 'max:2024',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->category_id = $request->category_id;
            $category->save();

            $category_image = CategoryImage::query()->where('category_id', $id)->first();
            // dd($category_image->url);

            if ($category_image->url && $request->image) {
                Storage::delete($category_image->url);
                $category_image->url = Storage::put('category_images', $request->image);

            } elseif ($request->image) {
                $category_image->url = Storage::put('category_images', $request->image);
            }
            $category_image->save();
            return response()->json([
                'status' => 'category edited',
                'massege' => $category,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massege' => $e,
            ], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $image = CategoryImage::where('category_id', $id)->first();
            // dd($images);
            if ($image) {


                if ($image->url)
                    Storage::delete($image->url);
                $image->delete();

            }
            Category::destroy($id);
            return response()->json([
                'status' => 'category Deleted',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massege' => $e,
            ], 500);

        }
    }
}
