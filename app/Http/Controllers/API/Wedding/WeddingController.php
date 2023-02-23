<?php

namespace App\Http\Controllers\API\Wedding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeddingCouple;
use DB;
use Validator;

class WeddingController extends Controller
{
    public function add_couple(Request $request){
        $eventId = $request->event_id;
        $couple = json_decode($request->couple);

        $validator = Validator::make($request->all(), [
            'event_id' => 'required|unique:wedding_couple',
            'couple' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            DB::beginTransaction();
            WeddingCouple::insert([
                [
                    "event_id" => $eventId,
                    "name" => $couple->groom->name,
                    "instagram" => $couple->groom->instagram,
                    "bio" => $couple->groom->bio,
                    "gender" => $couple->groom->gender
                ],
                [
                    "event_id" => $eventId,
                    "name" => $couple->bride->name,
                    "instagram" => $couple->bride->instagram,
                    "bio" => $couple->bride->bio,
                    "gender" => $couple->bride->gender
                ]
            ]);
            DB::commit();
            $currentCouple = WeddingCouple::where('event_id', $eventId)->get();
            return response()->json($currentCouple, 201);
        }catch(Exception $e){
            DB::rollback();
            return response()->json($e);
        }
    }
}
