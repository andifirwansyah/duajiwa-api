<?php

namespace App\Http\Controllers\API\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\ThemeCategory;

class ThemeController extends Controller
{
    public function list_themes(Request $request){
        // $category = $request->category;
        // $type = $request->type;

        $themes = Theme::with(['creator', 'category'])->paginate(10);

        $filter = [
            'category' => $request->category,
            'type' => $request->type == 'free' ? 0 : 1
        ];

        if($filter['category']){
            $themes = Theme::with(['creator', 'category'])->where('category', $filter['category'])->paginate(5);
        }

        if($filter['type'] == 0){
            $themes = Theme::with(['creator', 'category'])->where('is_premium', 0)->paginate(5);
        }

        return response()->json($themes, 200);
    }

    public function detail_theme(Request $request){
        $slug = $request->slug;
        $theme = Theme::with(['creator_d', 'category_d'])->where('slug', $slug)->first();
        return view('user.pages.theme.detail', compact('theme'));
    }

    public function preview_theme(Request $request){
        $slug = $request->slug;
        $theme = Theme::where('slug', $slug)->first();
        return view($theme->path);
    }
}
