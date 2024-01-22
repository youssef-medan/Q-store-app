<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function show(string $id)
    {
        if (Auth::user()) {
          $profile =  user::find(Auth::user()->id,['name','email','mobile','address','profile_picture','created_at']);
        //   dd(asset('public/storage/profiles_pictures/' . $profile->profile_picture));
          return view('profile.show',['profile'=>$profile]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()) {
            $profile =  user::find(Auth::user()->id,['name','email','mobile','address','profile_picture','created_at']);
            return view('profile.edit',['profile'=>$profile]);
          }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email',
            'mobile' => 'required|min:11|max:11',
            'address' => 'required|min:10|max:300',
            'profile_picture' => 'image|max:2048',

        ],[
            'mobile.min'=>'your phone number should be 11 numbers'
        ]);
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            if ($user->profile_picture && $request->file('profile_picture')) {
                Storage::delete($user->profile_picture);
                $user->profile_picture = Storage::put('profile_pictures',$request->file('profile_picture'));
            //   $extension =  $request->file('profile_picture')->getClientOriginalExtension();
            //   $filename = time().'.'.$extension;
            //   $request->file('profile_picture')->storeAs(('stoarge/app/public/profiles_pictures'),$filename);
            //   $user->profile_picture = $filename;


            }elseif($request->file('profile_picture')){
                $user->profile_picture = Storage::put('profile_pictures',$request->file('profile_picture'));

            }
            $user->save();


            return to_route('profile.show',Auth::user()->id)->with('massage','profile updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(Auth::user()->id);

        if ($user->profile_picture) Storage::delete($user->profile_picture);
        auth()->logout();
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        $user->name = 'anyone';
        $user->email = str::random(40);
        $user->password = '-';
        $user->email_verified_at = Null;
        $user->mobile = '-';
        $user->address	 = '-';
        $user->profile_picture	 = '';
        $user->created_at	 = Null;
        $user->updated_at	 = Null;
        $user->save();

        return to_route('home')->with('massage','your profile fully removed');

    }
}
