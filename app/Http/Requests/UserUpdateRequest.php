<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|max:255',
            'entry_date' => 'required|max:255',
            'siape' => 'required|max:255',
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'O campo nome é obrigatório.',
            'name.max'       => 'Limite de caracteres atingido.',
            'entry_date.required'  => 'O campo ingresso é obrigatório.',
            'entry_date.max'       => 'Limite de caracteres atingido.',
            'siape.required'  => 'O campo SIAPE é obrigatório.',
            'siape.max'       => 'Limite de caracteres atingido.',
        ];
    }
}
