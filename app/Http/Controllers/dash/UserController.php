<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\dash\UserCreateRequest;
use App\Http\Requests\dash\UserUpdateRequest;
use App\Models\User;
use App\Models\Product;
use App\Models\Image;
use App\Models\ShopingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        if ($request->has('role')) {
            switch ($request->role) {
                case 'user':
                    $role = 'user';
                    break;
                case 'admin':
                    $role = 'admin';
                    break;
                case 'superadmin':
                    $role = 'superadmin';
                    break;


                default:
                    $role = 'user';

                    break;
            }
        } else {
            $role = 'user';
        }

        if ($request->has('search')) {

            $users = User::query()
                ->where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')
                ->paginate(15)->appends([
                        'role' => $request->role,
                        'search' => $request->search,

                    ]);

        } else {

            $users = User::query()->where('role', $role)->orderBy('name', 'asc')
                ->paginate(15)->appends([
                        'role' => $request->role,

                    ]);
        }

        return view('dash-users.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash-users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {

        // dd($request->address);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),

        ]);
        if ($request->file('profile_picture')) {
            $user->profile_picture = Storage::put('profile_pictures', $request->file('profile_picture'));

        }
        $user->address = $request->address;
        $user->save();

        return to_route('users.index')->with('status', "User Added");

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $user = User::with(['shopingCartProducts.image', 'sellproducts.image'])->find($id);
        // if (Auth::guard('web')->user()->role == 'admin') {
        //     $user = User::with(['shopingCartProducts.image', 'sellproducts.image'])->find(Auth::guard('web')->user()->id);
        // }
        if (Auth::guard('web')->user()->role == 'admin') {
            $user = User::with(['shopingCartProducts.image', 'sellproducts.image'])->find(Auth::guard('web')->user()->id);
        }
        // dd($user);
        return view('dash-users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->find($id);
        if (Auth::guard('web')->user()->role == 'admin') {
            $user = User::find(Auth::guard('web')->user()->id);
        }
        return view('dash-users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {

        $user = User::find($id);
        if (Auth::guard('web')->user()->role == 'admin') {
            $user = User::find(Auth::guard('web')->user()->id);
        }


        if ($request->password) {
            $request->validate([
                'password' => 'required||min:6',

            ]);

            $user->password = Hash::make($request->password);


        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->mobile = $request->mobile;
        $user->address = $request->address;


        if ($user->profile_picture && $request->file('profile_picture')) {
            Storage::delete($user->profile_picture);
            $user->profile_picture = Storage::put('profile_pictures', $request->file('profile_picture'));



        } elseif ($request->file('profile_picture')) {
            $user->profile_picture = Storage::put('profile_pictures', $request->file('profile_picture'));

        }
        $user->save();

        return to_route('users.index')->with('status', 'User Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $products = $user->sellproducts;

        // foreach ($products as $product) {
        //     $carts = ShopingCart::where('product_id', $product->id)->get();
        //     if ($carts) {

        //         foreach ($carts as $cart) {

        //             $cart->delete();
        //         }
        //     }



        //     $images = Image::where('product_id', $product->id)->get();
        //     if ($images) {

        //         foreach ($images as $image) {
        //             if ($image->url)
        //                 Storage::delete($image->url);
        //             $image->delete();
        //         }
        //     }


        //     Product::destroy($product->id);
        // }


        // dd($images);




        $user = User::destroy($id);
        return to_route('users.index')->with('status', 'User Deleted');

    }
}
