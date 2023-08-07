<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'image' => 'nullable|image',
            'image_banner' => 'nullable|image',
            'video' => 'nullable|string',
            'description' => 'nullable|string',
            'duration' => 'nullable|numeric',
            'event_date' =>'nullable|date',
            'minimum_age' =>'nullable|numeric',
            'display_slider' =>'nullable|string',
            'partners_company_id' =>'nullable|string',
            'category_id' =>'nullable|string',
        ];
    }
}
