<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' .
                    $this->route('user')
            ],
            'role' => ['required', 'string', 'in:admin,client,user'],
            'init_role' => ['required', 'string', 'in:admin,client,user'],
            'company_name' => ['required_if:role,client', 'string', 'max:255', 'unique:clients,company_name,' . $this->route('user')],
            'bank_account_number' => ['required_if:role,client', 'numeric', 'digits_between:8,11', 'unique:clients,bank_account_number,' . $this->route('user')],
            'bank_account_name' => ['required_if:role,client', 'string', 'max:255'],
        ];
    }
}
