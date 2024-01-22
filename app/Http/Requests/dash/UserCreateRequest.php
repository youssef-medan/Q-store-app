<?php

namespace App\Http\Requests\dash;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required||min:11||max:11',
            'password' => 'required||min:6',
            'profile_picture' => 'max:2024',
            'role' => 'required',

        ];
    }
}
