<?php

use App\Http\Controllers\AllproductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dash\CategoryController as DashCategoryController;
use App\Http\Controllers\dash\CommentController;
use App\Http\Controllers\dash\DashLoginController;
use App\Http\Controllers\dash\DashRegisterController;
use App\Http\Controllers\dash\ImageController;
use App\Http\Controllers\dash\ProductController as DashProductController;
use App\Http\Controllers\dash\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopingCartController;
use App\Http\Controllers\WebAuthController;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::get('/', [HomeController::class,'home'])->name('home')->middleware(['user:web']);

Route::get('/categoryveiw/{category}', [CategoryController::class,'category_veiw'])->name('categoryveiw')->middleware('user:web')->missing(function(){return abort(404,'Category');});
Route::get('categoryveiw/products/{category}', [ProductController::class,'products'])->name('productsbycat')->middleware('user:web')->missing(function(){return abort(404,'Category');});

Route::get('allproducts', [ProductController::class,'allproducts'])->name('allproducts')->middleware('user:web');
Route::get('productveiw/{product}', [ProductController::class,'productveiw'])->name('productveiw')->middleware('user:web')->missing(function(){return abort(404,'Product');});
Route::post('addcomment', [ProductController::class,'productcomment'])->middleware(['user:web']);
Route::patch('commentedit/{id}',[ProductController::class,'commentedit'])->name('commentedit')->middleware('user:web');
Route::delete('commentdelete/{id}',[ProductController::class,'commentdelete'])->name('commentdelete')->middleware('user:web');

Route::resource('usercomments',ReviewController::class)->middleware('user:web');



Route::get('/web/register',[WebAuthController::class,'registercreate'])->name('webregister');
Route::post('/web/register', [WebAuthController::class,'registerstore']);
Route::get('/web/login', [WebAuthController::class,'login'])->name('weblogin');
Route::post('/web/login', [WebAuthController::class,'loginstore']);
Route::get('/web/logout', [WebAuthController::class,'logout'])->name('weblogout');

Route::get('shopingcart',[ShopingCartController::class,'shopcart'])->name('shopingcart')->middleware(['user:web','verified']);
Route::post('shopingcartplus/{id}',[ShopingCartController::class,'shopingcartplus'])->name('shopingcartplus')->middleware('user:web');
Route::post('shopingcartminus/{id}',[ShopingCartController::class,'shopingcartminus'])->name('shopingcartminus')->middleware('user:web');
Route::post('addtocart',[ShopingCartController::class,'addtocart'])->name('addtocart')->middleware('user:web');
// Route::delete('shopingcartdelete/{id}',[ShopingCartController::class,'shopcart'])->name('shopingcartdelete');
Route::delete('shopingcartdelete/{id}',[ShopingCartController::class,'shopingcartdelete'])->name('shopingcartdelete')->middleware('user:web');


Route::resource('profile',ProfileController::class)->except('index')->middleware('user:web');
// -------------dashboard------------------
Route::view('/dashboard', 'dashboard')->middleware(['auth','admin:web']);

Route::resource('/dashboard/register',DashRegisterController::class);
Route::resource('dashboard/login',DashLoginController::class);
Route::post('logout', [DashLoginController::class,'logout'])->name('logout');

Route::resource('dashboard/products',DashProductController::class)->middleware(['auth','admin:web']);
Route::resource('images',ImageController::class)->middleware(['auth','admin:web']);
Route::resource('dashboard/categories',DashCategoryController::class)->middleware(['auth','admin:web']);
Route::resource('dashboard/users',UserController::class)->middleware(['auth','admin:web'])->missing(function (Request $request) {
    return Redirect::back()->with('status','user not found');
});
Route::resource('dashboard/users',UserController::class)->only('index')->middleware(['auth','admin:web','superadmin:web']);
Route::resource('dashboard/comments',CommentController::class)->except('index')->middleware(['auth','admin:web','superadmin:web']);
Route::resource('dashboard/comments',CommentController::class)->only('index')->middleware(['auth','admin:web']);



Route::fallback(function () {
  return abort(404,'Page');
});








// Route::resource('categoryveiw', CategoryController::class);

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

