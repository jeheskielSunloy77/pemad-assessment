<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'in:admin,user,client'],
            'company_name' => ['required_if:role,client', 'string', 'max:255', 'unique:' . Client::class],
            'bank_account_number' => ['required_if:role,client', 'numeric', 'digits_between:8,11', 'unique:' . Client::class],
            'bank_account_name' => ['required_if:role,client', 'string', 'max:255'],
        ];
    }
}
