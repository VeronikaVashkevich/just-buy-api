<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => [
                'required',
                'max:255'
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:6'
            ]
        ];
    }
}
