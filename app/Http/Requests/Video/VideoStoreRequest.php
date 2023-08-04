<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'required|image',
            'image_banner' => 'nullable|image',
            'video' => 'nullable|string',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'event_date' =>'required|date',
            'minimum_age' =>'required|numeric',
            'display_slider' =>'nullable|string',
            'partners_company_id' =>'required|string',
            'category_id' =>'required|string',
        ];
    }
}
