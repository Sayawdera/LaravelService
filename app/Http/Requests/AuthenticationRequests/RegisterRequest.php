<?php

namespace App\Http\Requests\AuthenticationRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone' => ['required', 'string', 'unique:users,phone'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'code' => ['required', 'string'],
            'country_id' => ['nullable'],
            'password' => ['required'],
            'status' => ['nullable', 'numeric'],
        ];
    }
}
