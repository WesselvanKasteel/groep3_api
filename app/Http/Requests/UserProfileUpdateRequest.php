<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            'address' => ['string'],
            'city' => ['string'],
            'province' => ['string'],
            'country' => ['string'],
            'external_cv' => ['string'],
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

        ];
    }
}
