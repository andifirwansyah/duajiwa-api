<?php

namespace App\Http\Controllers\API\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function list_packages(Request $request){
        $packages = Package::with(['features.detail'])->get();
        return response()->json($packages);
    }
}
