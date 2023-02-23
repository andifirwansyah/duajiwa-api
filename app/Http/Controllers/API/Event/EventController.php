<?php

namespace App\Http\Controllers\API\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\ThemeCategory;
use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Support\Facades\Cookie;
use Validator;
use DB;

class EventController extends Controller
{
    public function list_events(Request $request){
        $user = $request->user();
        $events = Event::with(['detail', 'category', 'couple'])->where('user_id', $user->id)->get();
        return response()->json($events, 200);
    }

    public function add_new_event(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            DB::beginTransaction();
            $event = Event::create([
                'user_id' => $user->id,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category'),
                'step' => 1
            ]);
            DB::commit();
            return response()->json($event, 201);
        }catch(Exception $e){
            DB::rollback();
            return response()->json($e, 500);
        }
    }

    public function detail_event(Request $request){
        $validator = Validator::make($request->all(), [
            'event_id' => 'required',
            'name' => 'required',
            'start' => 'required',
            'timezone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'venue' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            DB::beginTransaction();
            $detail_event = EventDetail::create([
                'event_id' => $request->event_id,
                'is_main_event' => $request->is_main_event,
                'name' => $request->name,
                'start' => $request->start,
                'end' => $request->end,
                'timezone' => $request->timezone,
                'notes' => $request->notes,
                'lat' => $request->latitude,
                'long' => $request->longitude,
                'venue' => $request->venue,
                'city' => $request->city,
                'address' => $request->address,
            ]);
            DB::commit();
            return response()->json($detail_event, 201);
        }catch(Exception $e){
            DB::rollback();
            return response()->json($e, 500);
        }
    }

    public function update_step_event(Request $request){
        try {
            DB::beginTransaction();
            Event::where('id', $request->event_id)->update([
                'step' => $request->step
            ]);
            DB::commit();
            $event = Event::where('id', $request->event_id)->first();
            return response()->json($event, 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
