<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'email' => [
                'required',
                'max:255',
                'email',
            ],
            'password' => [
                'required',
                'min:6'
            ]
        ];
    }
}
