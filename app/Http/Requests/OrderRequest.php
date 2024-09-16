<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'recipient_name' => 'required|email|max:255',
            'number_phone' => 'required',
        ];
    }
}
