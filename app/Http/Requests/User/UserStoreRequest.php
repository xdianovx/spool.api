<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'surname' => 'required|string',
            'role' => 'required|integer',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'phone_number' => 'required|string|unique:users',
            'partner_company_id' =>'nullable|string'
        ];
    }
}
