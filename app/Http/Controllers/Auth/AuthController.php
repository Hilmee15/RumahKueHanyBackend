<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Common\CommonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|unique:users,fullname',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return CommonResponse::fail($validator->errors(), 400);
        }

        $passwordHash = Hash::make($request->input('password'));
        $inputUser = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => $passwordHash
        ];
        $user = User::create($inputUser);
        $token = $user->createToken('authToken')->plainTextToken;
        // ! Percabangan jika rolenya tidak diisi maka akan di assign role buyer
        if (!isset($request->role)) {
            $user->assignRole('customer');
        } else {
            $user->assignRole($request->role);
        }
        $response = [
            'id' => $user->id,
            'fullname' => $user->fullname,
            'email' => $user->email,
            'role' => $user->getRoleNames()->first(),
            'token' => $token
        ];
        return CommonResponse::success('Register berhasil', $response);
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return CommonResponse::fail($validator->errors(), 400);
        }


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
            // if (auth()->attempt($credentials)) {
            // $user = auth()->user();
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $response = [
                'id' => $user->id,
                'fullname' => $user->fullname,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
                'token' => $token
            ];
            return CommonResponse::success('Login berhasil', $response);
        } else {
            return CommonResponse::fail('Login gagal', 401);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->user()->currentAccessToken()->delete();
        return CommonResponse::success('Logout berhasil');
    }
}
