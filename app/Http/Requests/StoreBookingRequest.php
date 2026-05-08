<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Booking;

class StoreBookingRequest extends FormRequest
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
            // O usuário será coletado como o usuário logado no Controller, para medidas de segurança
            'space_id' => 'required|exists:spaces,id',
            'start_time' => 'required|date|after_or_equal:now', // não pode ser uma data do passado
            'end_time' => 'required|date|after:start_time'
        ];
    }
     public function messages()
     {
         return [
             'space_id.required' => 'É necessário selecionar um espaço.',
             'space_id.exists' => 'Selecione um espaço válido.',

             'start_time.required' => 'Data e hora de início são obrigatórias.',
             'start_time.after_or_equal' => 'A reserva não pode ser criada em uma data e hora do passado.',

             'end_time.required' => 'Data e hora de término são obrigatórias.',
             'end_time.after' => 'Data e hora deve acabar após a hora de início.'
         ];
     }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Se as regras básicas falharem (ex: deixou o campo vazio), nem tenta checar no banco
            if ($validator->errors()->any()) {
                return;
            }

            $spaceId = $this->input('space_id');
            $startTime = $this->input('start_time');
            $endTime = $this->input('end_time');

            //Uma reserva conflita se ela começa ANTES da outra terminar, e termina DEPOIS da outra começar.
            $conflito = Booking::where('space_id', $spaceId)
                ->where('status', '!=', 'cancelled') // Ignora reservas que foram canceladas
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                })
                ->exists();

            // Se achou conflito, cria um erro personalizado para o usuário ver
            if ($conflito) {
                $validator->errors()->add('start_time', 'Este espaço já possui uma reserva aprovada ou pendente que conflita com o horário selecionado.');
            }
        });
    }
}
