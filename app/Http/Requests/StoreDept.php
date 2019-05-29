<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDept extends FormRequest
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
          'org_id' => 'required|numeric',
          'avatar' => 'nullable|image|mimes:jpeg,bmp,png|max:1024',
          'name' => 'required|max:255|unique:depts,name,'.\Request::segment(2),
          'address' => 'nullable|max:255',
          'deptDetails' => 'nullable',
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
            'name.required' => 'The department name is required',
            'name.unique' => 'The department already exists!',
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
            'address' => 'location',
            'deptDetails' => 'department details',
        ];
    }
}
