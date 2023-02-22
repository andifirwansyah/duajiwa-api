<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function show(){
        return view('admin.pages.home.index');
    }

    public function logout(){
        // $sessionId = Session::get('sessionId');
        Auth::guard('admin')->logout();
        // Session::flush();
        return redirect('/');
    }
}
