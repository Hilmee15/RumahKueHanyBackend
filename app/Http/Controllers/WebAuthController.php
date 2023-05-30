<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WebAuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

       $request->validate([
        'fullname' => 'required',
        'password' => 'required|min:8'
       ]);


        $loginType = filter_var($request->input('fullname'), FILTER_VALIDATE_EMAIL) ? 'email' : 'fullname';

        // ! Percabangan jika loginType nya email maka akan di cek emailnya, jika bukan maka akan dicek fullnamenya
        /**
         * $credentials = PENGENAL
         */
        $credentials = [
            $loginType => $request->input('fullname'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            return back()->with('error', 'invalid credential');
        }
    }
}
