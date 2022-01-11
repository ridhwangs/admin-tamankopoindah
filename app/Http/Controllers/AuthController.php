<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            return redirect()->route('dashboard');
        }
        return view('admin.authentication.login_one');
    }

    public function login(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('email','password');

        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            return redirect()->intended('/');
        }

        return redirect()->route('login')->withInput()->withErrors(['message' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return redirect()->route('login');
    }
}
