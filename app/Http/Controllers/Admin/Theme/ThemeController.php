<?php

namespace App\Http\Controllers\Admin\Theme;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Creator;
use App\Models\ThemeCategory;
use Validator;
use DB;

class ThemeController extends Controller
{
    public function list_themes(Request $request){
        $keyword = $request->keyword;
        $themes = Theme::with(['creator_d','category_d'])->paginate(5);
        if($keyword){
            $themes = Theme::with(['creator_d','category_d'])->whereRaw(" (`id` like ? or `name` like ? or `creator` like ? ) ",["%".$keyword."%","%".$keyword."%","%".$keyword."%"])
                ->paginate(5);
        }
        return view('admin.pages.theme.index', compact('themes'));
    }
    public function create_themes(Request $request){
        if($request->isMethod('GET')){
            $creators = Creator::where('status', 1)->get();
            $categories = ThemeCategory::where('status', 1)->get();
            return view('admin.pages.theme.add', compact('creators', 'categories'));
        }
        return $this->_handle_create_new_themes($request);
    }

    public function _handle_create_new_themes($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:themes',
            'description' => 'required',
            'thumbnail' => 'required',
            'design_capture' => 'required',
            'creator' => 'required',
            'category' => 'required',
            'theme_file' => 'required',
        ]);

        if($validator->fails()){
            return redirect('/theme/create')->withErrors($validator);
        }

        $themePath = $this->_do_upload_theme($request);
        $thumbnailUrl = $this->_do_upload_thumbnail($request);
        $designCaptureUrl = $this->_do_upload_design_capture($request);

        if(!$themePath){
            return redirect('/theme/create')->withErrors(['theme_file' => 'The theme name is available']);
        }

        try {
            DB::beginTransaction();

            Theme::create([
                'name' => $request->input('name'),
                'slug' => \Str::slug($request->input('name')),
                'description' => $request->input('description'),
                'thumbnail' => $thumbnailUrl,
                'design_capture' => $designCaptureUrl,
                'cost' => $request->input('theme_cost'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'is_premium' => $request->input('price') ? true : false,
                'demo_subdomain' => env('APP_URL').'/theme/'.\Str::slug($request->input('name')),
                'path' => $themePath,
                'creator_id' => $request->input('creator'),
                'category_id' => $request->input('category'),
                'tags' => json_encode($request->input('tags')),
                'is_published' => $request->input('published') ? true : false,
                'show_author_name' => $request->input('show_author_name') ? true : false,
            ]);
            DB::commit();
            return redirect('/theme')->with('success', 'Theme saved!');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function _do_upload_theme($request){
        $themePath = null;

        if($themeFile = $request->file('theme_file')){
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', 'index') . time() . '.blade.php';
            $dirName  = preg_replace("/[^a-z]+/", '', $request->input('name'));
            if(Storage::disk('resources_views')->exists($dirName)){
                // return response()->json([
                //     'message' => 'The theme name is available'
                // ]);
                return false;
            }
            $path = 'themes.'.$dirName.'.'.preg_replace('/[^A-Za-z0-9\-]/', '', 'index') . time();
            Storage::disk('resources_views')->put($dirName.'/'.$fileName, file_get_contents($themeFile));
            $themePath = $path;
        }

        return $themePath;
    }

    public function _do_upload_thumbnail($request){
        $thumbnailUrl = null;

        if($thubmnailFile = $request->file('thumbnail')){
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', pathinfo($thubmnailFile->getClientOriginalName())['filename']) . time() . '.' .$thubmnailFile->getClientOriginalExtension();
            $pathName  = preg_replace("/[^a-z]+/", '', $request->input('name'));
            $directory = "upload/themes/".$pathName;
            $thubmnailFile->move(public_path($directory), $fileName);
            $thumbnailUrl = url($directory).'/'.$fileName;
        }

        return $thumbnailUrl;
    }

    public function _do_upload_design_capture($request){
        $designCaptureUrl = null;

        if($designCapture = $request->file('design_capture')){
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', pathinfo($designCapture->getClientOriginalName())['filename']) . time() . '.' .$designCapture->getClientOriginalExtension();
            $pathName  = preg_replace("/[^a-z]+/", '', $request->input('name'));
            $directory = "upload/themes/design".$pathName;
            $designCapture->move(public_path($directory), $fileName);
            $designCaptureUrl = url($directory).'/'.$fileName;
        }

        return $designCaptureUrl;
    }
}
