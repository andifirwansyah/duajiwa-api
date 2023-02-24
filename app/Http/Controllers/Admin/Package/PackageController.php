<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageFeature;
use App\Models\PackageMain;
use Illuminate\Http\Request;
use DB;
use Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::get();
        return view('admin.pages.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = PackageFeature::get();
        $package = [];
        return view('admin.pages.package.add', compact('features', 'package'));
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'features' => 'required'
        ]);

        if($validator->fails()){
            return redirect('package/create')->withErrors($validator);
        }
        $features = $request->input('features');

        DB::beginTransaction();
        try {
            $package = Package::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price
            ]);
            $results = [];
            foreach($features as $feature){
                $v = [
                    'package_id' => $package->id,
                    'feature_id' => $feature
                ];
                array_push($results, $v);
            }
            PackageMain::insert($results);

            DB::commit();
            return redirect('package/create')->with('success', 'Package successfully saved!');
        } catch (\Throwable $th) {
            DB::commit();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $features = PackageFeature::get();
        $featureSelected = PackageMain::where('package_id', $package->id)->get();
        $selected = [];
        foreach($featureSelected as $val){
            $v = $val->feature_id;
            array_push($selected, $v);
        }
        $package['selected'] = $selected;

        return view('admin.pages.package.add', compact('features', 'package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'features' => 'required'
        ]);

        if($validator->fails()){
            return redirect('package/'.$package->id.'/edit')->withErrors($validator);
        }
        $features = $request->input('features');

        DB::beginTransaction();
        try {
            Package::where('id', $package->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price
            ]);
            PackageMain::where('package_id', $package->id)->delete();

            $results = [];
            foreach($features as $feature){
                $v = [
                    'package_id' => $package->id,
                    'feature_id' => $feature
                ];
                array_push($results, $v);
            }
            PackageMain::insert($results);
            DB::commit();
            return redirect('package')->with('success', 'Package successfully updated!');
        } catch (\Throwable $th) {
            DB::commit();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        PackageMain::where('package_id', $package->id)->delete();
        Package::where('id', $package->id)->delete();
        return redirect('package')->with('success', 'Package successfully deleted!');
    }
}
