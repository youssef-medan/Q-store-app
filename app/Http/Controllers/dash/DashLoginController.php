<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\dash\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DashLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
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
    public function store(LoginRequest $request)
    {
        if (Auth::user()) {

            auth()->logout();
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

        }
      

        $user = User::firstWhere('email', $request->email);
        if ($user && Hash::check($request->password, $user->password)) {



            if (Auth::attempt($request->except('_token'))) {
                $request->session()->regenerate();
            }

            if (Auth::user()->role == 'user') {
                auth()->logout();
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return to_route('login.index')->with('status', 'you not Allowed to login here');


            }

            return redirect('/dashboard')->with('welcome', "welcome Auth::user()->name ");
        }else{
            return to_route('login.index')->with('status', 'invalied email or password');

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/dashboard');
    }
}
