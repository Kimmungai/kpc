<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'type' => 'required|numeric',
            'avatar' => 'nullable|image|mimes:jpeg,bmp,png|max:1024',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'DOB' => 'required|date|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phoneNumber' => 'required|numeric|digits_between:10,15',
            'gender' => 'required|numeric',
            'address' => 'required|max:255',
            'idNo' => 'nullable|numeric|digits_between:5,10',
            'passport' => 'nullable|max:255',
            'idImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'passportImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'password' => 'required|min:8|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstName.required' => 'The first name is required',
            'lastName.required' => 'The last name is required',
            'DOB.required' => 'The date of birth (DOB) is required',
            'email' => 'Please enter a valid email address',

        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'avatar' => 'picture',
            'email' => 'email address'
        ];
    }
}
