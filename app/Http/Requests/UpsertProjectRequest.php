<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertProjectRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'price' => ['required', 'numeric'],
            'status' => ['required', 'string', 'in:application,planing,ongoing,finished'],
            'user_id' => ['required_if:client_id,null', 'exists:users,id'],
            'client_id' => ['required_if:user_id,null', 'exists:clients,id'],
            'service_id' => ['required', 'exists:services,id'],
            'payment_due_date' => [
                'nullable', 'required_if:status,finished',
                'required_with:paid_at',
                'date', 'after:today'
            ],
            'paid_at' => ['nullable', 'date'],
        ];
    }
}
