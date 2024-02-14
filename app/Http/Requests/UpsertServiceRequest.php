<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string', 'in:translation,transcribing,writing,editing,proofreading,other'],
            'language' => ['required', 'string', 'in:english,bahasa,french,spanish,german,italian,portuguese,dutch,russian,chinese,japanese,arabic,other']
        ];
    }
}
