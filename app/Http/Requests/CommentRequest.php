<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'product_id' => 'required|numeric|exists:products,id',
            'user_id' => 'required|numeric|exists:users,id',
            'description' => 'required|max:150||min:5',

        ];
    }

    public function messages()
    {
        return [
            'description.min' =>'Your Comment must be at least 5 characters.'

        ];
    }
}
