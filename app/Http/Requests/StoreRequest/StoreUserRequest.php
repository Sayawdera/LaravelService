<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'date' => ['required', 'date'],
            'photo' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'phone_verified_at' => ['nullable', 'timezone'],
            'email' => ['required', 'email'],
            'email_verified_at' => ['nullable', 'timezone'],
            'password' => ['required', 'string'],
            'country_id' => ['required', 'numeric'],
        ];
    }
}
