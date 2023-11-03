<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->parent_id == 0):
            $parent_id = null;
        else:
            $parent_id = $this->parent_id;
        endif;
        return [
            "id" => $this->id,
            "name"=> $this->name,
            "sort"=> $this->sort,
            "slug"=> $this->slug,
            "parent_id"=>  $parent_id,
            "image"=> env('API_URL') . Storage::url($this->image),
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
        ];
 
    }
}
