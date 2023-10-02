<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
            'price' => 'required|integer',
            'discounted_price' => 'nullable|integer',
            'video_id' => 'required|string|unique:tickets',
        ];
    }
        public function messages()
    {
        return [
            'video_id.unique' => 'Билет к данной записи уже существует',
        ];
    }
}
