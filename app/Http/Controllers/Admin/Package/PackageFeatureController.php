<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\PackageFeature;
use Illuminate\Http\Request;
use DB;
use Validator;

class PackageFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = PackageFeature::get();
        return view('admin.pages.package.list_feature', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.package.add_feature');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return redirect('package-feature/create')->withErrors($validator);
        }

        DB::beginTransaction();
        try {

            PackageFeature::create([
                'name' => $request->input('name')
            ]);

            DB::commit();
            return redirect('package-feature/create')->with('success', 'Package feature successfully saved!');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function show(PackageFeature $packageFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageFeature $packageFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageFeature $packageFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageFeature $packageFeature)
    {
        //
    }
}
