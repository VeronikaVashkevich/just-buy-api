<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'max:255',
            ],
            'description' => [
                'max:512'
            ],
            'price' => [
                'min:0.01',
                'numeric'
            ]
        ];
    }
}
