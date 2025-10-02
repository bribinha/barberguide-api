<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // No momento todos podem criar um agendamento.
        // No futuro, poderemos checar aqui se o usuário está logado.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'professional_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'professional_id' => 'profissional',
            'client_id' => 'cliente',
            'service_id' => 'serviço',
            'start_time' => 'horário de início',
            'end_time' => 'horário de término',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            // Mensagens de campos obrigatórios
            'required' => 'O campo :attribute é obrigatório.',

            // Mensagens específicas
            'professional_id.exists' => 'O profissional selecionado não é válido.',
            'client_id.exists' => 'O cliente selecionado não é válido.',
            'service_id.exists' => 'O serviço selecionado não é válido.',
            'start_time.date_format' => 'O campo :attribute deve estar no formato AAAA-MM-DD HH:MM:SS.',
        ];
    }
}
