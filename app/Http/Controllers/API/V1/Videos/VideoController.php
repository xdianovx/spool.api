<?php

namespace App\Http\Controllers\API\V1\Videos;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideos()
    {
        $videos = VideoResource::collection(Video::where('ticket_availability', true)->orderBy('event_date', 'ASC')->get());

        return response()->json($videos);
    }
    
}
