<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'country' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'date_of_birth' => ['date'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

     /**
     * Custom messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Name is required!',
            'last_name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password needs to be at least six characters long!',
        ];
    }
}
