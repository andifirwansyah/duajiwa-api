<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use DB;
use Hash;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|regex:/[0-9]{9}/|unique:users',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try {
            DB::beginTransaction();

            $last_phone = substr($request->phone, strlen($request->phone) - 4, strlen($request->phone));
            $generate_username = preg_replace("/[^a-zA-Z]+/", "", $request->name);
            $username = strtolower($generate_username).$last_phone;

            $user = User::create([
                'name' => $request->input('name'),
                'username' => $username,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
            ]);
            DB::commit();

            $token = $user->createToken($request->email)->plainTextToken;

            return response()->json([
                'userdata' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
