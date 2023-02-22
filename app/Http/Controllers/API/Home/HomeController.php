<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function home(Request $request){
        return view('user.pages.home.index');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
