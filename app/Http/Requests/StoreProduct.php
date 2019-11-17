<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
        'type' => 'nullable|numeric',
        'image' => 'nullable|image|mimes:jpeg,bmp,png|max:1024',
        'name' => 'required|max:255|unique:depts,name,'.\Request::segment(2),
        'description' => 'nullable',
        'sku' => 'required',
        'price' => 'required|numeric',
        'cost' => 'required|numeric',
        'quantity' => 'required|numeric',
        'dept_id' => 'required|numeric',
      ];
    }
}
