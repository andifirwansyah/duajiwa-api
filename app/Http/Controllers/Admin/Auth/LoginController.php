<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use DB;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('GET')){
            if(Auth::guard('admin')->user()){
                return redirect()->intended('/');
            }
            return view('admin.pages.auth.login');
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/login')->withErrors($validator);
        }

        $admin = User::where('email', $request->input('email'))->first();
        if(!$admin){
            return redirect('/login')->withErrors(["email" => "We couldn't find your email."]);
        }elseif(!Hash::check($request->password, $admin->password)){
            return redirect('/login')->withErrors(["password" => "Your password is wrong."]);
        }

        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect('/');
        }

        return redirect("/login")->withErrors(['message','Login details are not valid']);
    }
}
