<?php

namespace App\Http\Controllers\dash\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\ShopingCart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required||min:11',
            'password' => 'required||min:6',
            'profile_picture' => 'max:2024',
            'role' => 'required',

        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'role' => $request->role,
                'password' => Hash::make($request->password),

            ]);
            if ($request->profile_picture) {
                $user->profile_picture = Storage::put('profile_pictures', $request->profile_picture);

            }
            $user->address = $request->address;
            $user->save();
            return response()->json([
                'status' => 'new user added',
                'massege' => $user,
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
        try {
            $user = User::find($id);


            if ($request->password) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'mobile' => 'required||min:11',
                    'password' => 'required||min:6',
                    'profile_picture' => 'max:2024',
                    'role' => 'required',
                ]);
                $user = User::find($id);
                $user->name = $request->name;
                $user->role = $request->role;
                $user->password = Hash::make($request->password);
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->address = $request->address;

            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'mobile' => 'required||min:11',
                    'profile_picture' => 'max:2024',
                    'role' => 'required',
                ]);
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->mobile = $request->mobile;
                $user->address = $request->address;

            }

            if ($user->profile_picture && $request->profile_picture) {
                Storage::delete($user->profile_picture);
                $user->profile_picture = Storage::put('profile_pictures', $request->profile_picture);



            } elseif ($request->profile_picture) {
                $user->profile_picture = Storage::put('profile_pictures', $request->profile_picture);

            }
            $user->save();
            return response()->json([
                'status' => 'User edited',
                'massege' => $user,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massege' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $products = $user->sellproducts;

            foreach ($products as $product) {
                $carts = ShopingCart::where('product_id', $product->id)->get();
                if ($carts) {

                    foreach ($carts as $cart) {

                        $cart->delete();
                    }
                }



                $images = Image::where('product_id', $product->id)->get();
                if ($images) {

                    foreach ($images as $image) {
                        if ($image->url)
                            Storage::delete($image->url);
                        $image->delete();
                    }
                }


                Product::destroy($product->id);
            }




            $user = User::destroy($id);

            return response()->json([
                'status' => 'User deleted',
            ]);



        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massege' => $e->getMessage() ,
            ]);


        }
    }
}
