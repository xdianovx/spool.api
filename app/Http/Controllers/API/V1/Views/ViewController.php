<?php

namespace App\Http\Controllers\API\V1\Views;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\View;
use Illuminate\Http\Request;
use Validator;

class ViewController extends Controller
{
    public function storeView(Request $request)
    {
        $client = Client::find(auth('api')->user('api')->id);
        $validator = Validator::make($request->all(), [
            'seconds_viewed'=> 'required|integer',
            'video_id'=> 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $view = View::where('client_id',$client->id)->where('video_id',$validator->validated()['video_id'])->exists();
       
        if($view == false):
            $client->views_store()->firstOrCreate([
                'video_id' => $validator->validated()['video_id'], 
                'country_id' => $client->country_id,
            ],$validator->validated());
            return response()->json([
                'message' => 'created'
            ], 200);
        else:
            View::where('client_id',$client->id)->where('video_id',$validator->validated()['video_id'])->update($validator->validated());
            return response()->json([
                'message' => 'updated'
            ], 200);
        endif;
        
      
    }
}
