<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:20',
            'first_name' => 'required|string|min:1|max:64',
            'last_name' => 'required|string|min:2|max:64',
            'phone' => 'required|string|min:6|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:100',
        ];
    }
}
