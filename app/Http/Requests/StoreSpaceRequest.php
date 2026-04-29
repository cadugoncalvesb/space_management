<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpaceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:active,inactive, maintenance',
            'local_id' => 'required|exists:locals,id',
        ];
    }

    public function messages(): array
    {
        return [
          'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser texto.',
            'name.max' => 'O campo nome não deve ultrapassar 255 caracteres.',

            'type.required' => 'O campo tipo é obrigatório.',
            'type.string' => 'O campo tipo deve ser texto.',
            'type.max' => 'O campo tipo não deve ultrapassar 255 caracteres.',

            'capacity.required' => 'O campo capacidade é obrigatório.',
            'capacity.integer' => 'O campo capacidade deve ser inteiro.',
            'capacity.min' => 'O campo capacidade não pode ser menor que 1.',

            'status.required' => 'O campo status é obrigatório.',
            'status.string' => 'O campo status deve ser texto.',
            'status.in' => 'Selecione um status válido na lista.',

            'local_id.required' => 'Selecione o local na qual o espaço pertece.',
            'local_id.exists' => 'Prédio selecionado inválido ou inexistente.',

        ];
    }
}
