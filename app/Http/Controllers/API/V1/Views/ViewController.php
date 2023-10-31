<?php

namespace App\Http\Controllers\API\V1\Views;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Video;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ViewController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function storeView(Request $request)
    {
        $client = Client::findOrFail(auth('api')->user('api')->id);

        $validator = Validator::make($request->all(), [
            'seconds_viewed' => 'required|integer',
            'video_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Video::where('id', $validator->validated()['video_id'])->exists()) :
            return response()->json([
                'status' => 'failed',
                'error' => 'There is no video with this ID',
            ], 404);
        endif;

        if (!View::where('client_id', $client->id)->where('video_id', $validator->validated()['video_id'])->exists()) :

            $client->views_store()->create([
                'seconds_viewed' => $request->seconds_viewed,
                'video_id' => $validator->validated()['video_id'],
                'country_id' => $client->country_id ?? 131,
            ], $validator->validated());

            Video::where('id', $validator->validated()['video_id'])->increment('views_count');

            return response()->json([
                'message' => 'created'
            ], 200);

        else :
            if (Carbon::now()->startOfDay()->gte(View::where('client_id', $client->id)->where('video_id', $validator->validated()['video_id'])
                ->orderBy('created_at', 'desc')->first()->created_at)) :

                $client->views_store()->create([
                    'seconds_viewed' => $request->seconds_viewed,
                    'video_id' => $validator->validated()['video_id'],
                    'country_id' => $client->country_id ?? 131,
                ], $validator->validated());

                Video::where('id', $validator->validated()['video_id'])->increment('views_count');

                return response()->json([
                    'message' => 'created for the current day'
                ], 200);
            else :

                View::where('client_id', $client->id)->where('video_id', $validator->validated()['video_id'])
                    ->orderBy('created_at', 'desc')->first()->update([
                        'seconds_viewed' => $request->seconds_viewed,
                        'country_id' => $client->country_id ?? 131,
                    ], $validator->validated());
                return response()->json([
                    'message' => 'updated'
                ], 200);
            endif;
        endif;
    }
}
