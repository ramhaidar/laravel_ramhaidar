<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm ()
    {
        return view ( 'auth.login' );
    }

    public function login ( Request $request )
    {
        $credentials = $request->only ( 'username', 'password' );

        if ( Auth::attempt ( $credentials ) )
        {
            return redirect ()->intended ( 'dashboard' );
        }

        return redirect ( 'login' )->with ( 'error', 'Username atau password salah!' );
    }

    public function logout ()
    {
        Auth::logout ();
        return redirect ( 'login' );
    }
}
