<?php

namespace App\Http\Requests\dash;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name'=> 'required',
            'price'=> 'required',
            'category_id'=> 'required',
            'url'=> 'required|max:2024',
            'description'=> 'required',
            'user_id'=> 'required'
        ];
    }
}
