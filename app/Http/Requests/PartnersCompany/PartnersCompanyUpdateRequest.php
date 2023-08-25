<?php

namespace App\Http\Requests\PartnersCompany;

use Illuminate\Foundation\Http\FormRequest;

class PartnersCompanyUpdateRequest extends FormRequest
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
            'name' => 'required|string|unique:partners_companies,name,' . $this->partners_company_id,
            'partners_company_id' => 'required|integer|exists:partners_companies,id'
        ];
    }
}
