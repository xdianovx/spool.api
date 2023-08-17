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
        $video = VideoResource::collection(Video::all());
        return response()->json($video);
    }
}
