<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => 'required|min:2|string|max:255',
            'price' => 'required',
            'unsold_quantity' => 'required|min:1',
            'description' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,webp|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'image.*.mimes' => 'Yêu cầu ảnh jpeg,png,webp.',
        ];
    }
}
