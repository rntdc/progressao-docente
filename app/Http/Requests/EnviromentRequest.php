<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnviromentRequest extends FormRequest
{
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
            'reitor_name' => 'required|max:255',
            'cppd_president' => 'required|max:255',
            'cppd_secretary' => 'required|max:255',
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
            'reitor_name.required'     => 'O campo do nome do Reitor é obrigatório.',
            'reitor_name.max'          => 'Limite de caracteres atingido.',
            'cppd_president.required'  => 'O campo do Presidente é obrigatório.',
            'cppd_president.max'       => 'Limite de caracteres atingido.',
            'cppd_secretary.required'  => 'O campo do Secretário é obrigatório.',
            'cppd_secretary.max'       => 'Limite de caracteres atingido.',
        ];
    }
}
