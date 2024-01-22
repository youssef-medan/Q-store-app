<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;



class WebAuthController extends Controller
{
    public function registercreate(){
        return view('register');
    }

    public function registerstore(RegisterRequest $request){

        if (Auth::user()) {

            auth()->logout();
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

        }



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));



        $credentials =  $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();}



        return to_route('profile.edit',Auth::user()->id)->with('status','change your profile picture');
    }


    public function login(){
        return view('login');
    }



    public function loginstore(LoginRequest $request){


        $user = User::firstWhere('email', $request->email);
        if ($user && Hash::check($request->password, $user->password)) {

                if (Auth::guard('web')->attempt($request->except('_token'))) {
                    $request->session()->regenerate();}


                    return redirect('/')->with('welcome',"welcome Auth::user()->name ");
            }

            else{return to_route('weblogin')->with('status','login error your email or password wrong');  }





    }
    public function logout(request $request){
        auth()->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
}
