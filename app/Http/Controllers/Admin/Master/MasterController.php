<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\ThemeCategory;
use App\Models\Theme;
use Validator;
use DB;

class MasterController extends Controller
{
    public function list_creators(Request $request){
        $keyword = $request->keyword;
        $creators = Creator::paginate(5);
        if($keyword){
            $creators = Creator::whereRaw(" (`id` like ? or `name` like ?) ",["%".$keyword."%","%".$keyword."%"])
                ->paginate(5);
        }
        return view('admin.pages.creator.index', compact('creators'));
    }

    public function add_new_creator(Request $request){
        if($request->isMethod('GET')){
            return view('admin.pages.creator.add');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:creators',
            'ltd' => 'required',
        ]);

        if($validator->fails()){
            return redirect('/setting/creator/add')->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            Creator::create([
                'name' => $request->input('name'),
                'ltd' => $request->input('ltd'),
            ]);
            DB::commit();
            return redirect('/setting/creator')->with('success', 'Creator saved!');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

    }

    public function list_categories(Request $request){
        $keyword = $request->keyword;
        $categories = ThemeCategory::paginate(5);
        if($keyword){
            $categories = ThemeCategory::whereRaw(" (`id` like ? or `name` like ?) ",["%".$keyword."%","%".$keyword."%"])
                ->paginate(5);
        }
        return view('admin.pages.theme_category.index', compact('categories'));
    }

    public function add_new_theme_category(Request $request){
        if($request->isMethod('GET')){
            return view('admin.pages.theme_category.add');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:theme_categories',
        ]);

        if($validator->fails()){
            return redirect('/setting/theme-category/add')->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            ThemeCategory::create([
                'name' => ucwords($request->input('name')),
            ]);
            DB::commit();
            return redirect('/setting/theme-category')->with('success', 'Category saved!');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

    }
}
