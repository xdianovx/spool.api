<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'avatar_image' => 'image|nullable|max:1999',
            'name' => 'nullable|string',
            'gender' => 'nullable|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|string|email|unique:clients,email,' . $this->client_id,
            'client_id' => 'nullable|integer|exists:clients,id',
            'phone_number' => 'nullable|numeric',
            'country_id' =>'nullable|string',
        ];
    }
}
