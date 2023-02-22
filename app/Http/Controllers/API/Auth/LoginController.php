<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json(['email' => 'Email yang anda berikan tidak ditemukan.'], 404);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['password' => 'Kata sandi yang anda masukkan salah.'], 400);
        }

        if($user->tokens()->where('name', $request->email)->first()) {
            $user->tokens()->where('tokenable_id', $user->id)->delete();
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'userdata' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ],200);
    }
}
