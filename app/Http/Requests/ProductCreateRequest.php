<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
                'sometimes',
                'max:255',
            ],
            'description' => [
                'sometimes',
                'max:512'
            ],
            'price' => [
                'sometimes',
                'min:0.01',
                'numeric'
            ]
        ];
    }
}
