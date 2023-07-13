<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessorUpdateRequest extends FormRequest
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
        $userId = $this->route('professor');

        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255',Rule::unique('users')->ignore($userId)
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
            'email.required' => 'O email é obrigatório.',
            'email.max'      => 'Limite de caracteres atingido.',
            'email.unique'   => 'O email já está cadastrado.',
        ];
    }
}
