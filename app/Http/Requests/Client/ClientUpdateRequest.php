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
            'name' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|integer',
            'email' => 'required|string|email|unique:clients,email,' . $this->client_id,
            'client_id' => 'required|integer|exists:clients,id',
            'phone_number' => 'required|numeric',
            'country_id' =>'nullable|string',
            'avatar_image' => 'nullable|image',
        ];
    }
}
