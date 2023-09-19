<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionsStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'pontuation' => 'required|numeric',
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
            'pontuation.required' => 'O campo pontuação é obrigatório.',
            'pontuation.numeric' => 'Deve ser um valor numérico.',
        ];
    }
}
