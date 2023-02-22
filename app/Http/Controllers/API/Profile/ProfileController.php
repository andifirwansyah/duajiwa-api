<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use DB;
use Hash;

class ProfileController extends Controller
{
    public function show_profile(Request $request){
        $user = $request->user();
        return response()->json($user, 200);
    }

    public function update_profile(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $avatar = $this->_do_upload_avatar($request, $user);
        if(!$avatar){
            $avatar = $user->avatar;
        }
        try {
            DB::beginTransaction();
            User::where('id', $user->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'avatar' => $avatar
            ]);
            DB::commit();
            $updatedUser = User::where('id', $user->id)->first();
            return response()->json($updatedUser, 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function update_password(Request $request){
        $user = $request->user();

        if(!Hash::check($request->input('old_password'), $user->password)){
            return response()->json(['old_password' => 'Kata sandi tidak cocok dengan kata sandi lama.'], 400);
        }

        if($request->input('new_password') != $request->input('new_password_confirmation')){
            return response()->json(['new_password_confirmation' => 'Kata sandi tidak cocok.'], 400);
        }

        try {
            DB::beginTransaction();
            User::where('id', $user->id)->update([
                'password' => Hash::make($request->input('new_password'))
            ]);
            DB::commit();
            return response()->json(['successfully'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function _do_upload_avatar($request, $user){
        $avatar = null;

        if($avatarFile = $request->file('avatar')){
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', pathinfo($avatarFile->getClientOriginalName())['filename']) . time() . '.' .$avatarFile->getClientOriginalExtension();
            $pathName  = preg_replace("/[^a-z]+/", '', $request->input('name'));
            $directory = "upload/user/". $user->username ."/avatar".$pathName;
            $avatarFile->move(public_path($directory), $fileName);
            $avatar = url($directory).'/'.$fileName;
        }

        return $avatar;
    }
}
