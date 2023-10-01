<?php

namespace App\Http\Resources;

use App\Models\Tag;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->image_banner) :
            $image_banner = env('API_URL') . Storage::url($this->image_banner);
        else:
            $image_banner = $this->value('image_banner');
        endif;
        
        $tags = TagResource::collection(Tag::orderBy('id', 'ASC')->where('video_id', $this->id)->get());
        $ticket = Ticket::where('video_id', $this->id)->get();
        
        return [
            'id' => $this->id,
            "name" => $this->name,
            "image" => env('API_URL') . Storage::url($this->image),
            "image_banner" => $image_banner,
            "video" => 'https://cdn.spoolapp.ru/videos/' . $this->video,
            "description" => $this->description,
            "duration" => $this->duration,
            "event_date" => $this->event_date,
            "minimum_age" => $this->minimum_age,
            "display_slider" => $this->display_slider,
            "category" => $this->category->name ?? null,
            "partners_company" => $this->partner_company->name,
            'views_count' => $this->views_count,
            "ticket" => $ticket,
            "tags" => $tags,

        ];
    }
}
