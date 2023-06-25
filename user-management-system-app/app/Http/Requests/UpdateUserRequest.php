<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|max:255',
            'last_name' => 'nullable|max:255',
            'phone' => 'nullable|unique:users,phone,' . $this->user()->id,
            'username' => 'nullable|unique:users,username,' . $this->user()->id,
            'email' => 'nullable|email|unique:users,email,' . $this->user()->id
        ];
    }
}
