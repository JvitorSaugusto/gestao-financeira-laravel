<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'description' => ['required', 'string', 'min:3', 'max:150'],
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'in:income,expense' ],
            'date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'A descrição é obrigatória.',
            'description.string'   => 'A descrição deve ser um texto válido.',
            'description.min'      => 'A descrição deve ter pelo menos :min caracteres.',
            'description.max'      => 'A descrição não pode ter mais que :max caracteres.',

            'category_id.required' => 'A seleção de uma categoria é obrigatória.',
            'category_id.exists'   => 'A categoria selecionada não existe em nosso sistema.',

            'amount.required'      => 'O valor da transação é obrigatório.',
            'amount.numeric'       => 'O valor deve ser um número válido (ex: 150.50).',
            'amount.min'           => 'O valor não pode ser negativo.',

            'type.required'        => 'O tipo de transação é obrigatório.',
            'type.in'              => 'O tipo de transação é inválido. Escolha entre Receita (income) ou Despesa (expense).',

            'date.date'            => 'A data informada não é válida.',
        ];
    }
}
