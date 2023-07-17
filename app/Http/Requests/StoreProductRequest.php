<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'productName' => ['required', 'string', 'max:255'],
            'productCategory' => ['required'],
            'brand' => ['required'],
            'price' => ['required', 'integer'],
            'color' => ['required'],
            'size' => ['required'],
            'quantity' => ['required','integer'],
            'discount' => ['required','integer'],
            'description' => ['required', 'string', 'max:255'],
//            'images'=>['required'],
        ];
    }
}
