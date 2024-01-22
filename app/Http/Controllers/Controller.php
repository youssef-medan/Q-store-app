<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $dropCategories = Category::with('sub_categories')->whereNull('category_id')->get();



        // Make it available to all views by sharing it
        view()->share('dropCategories', $dropCategories);
    }
}
