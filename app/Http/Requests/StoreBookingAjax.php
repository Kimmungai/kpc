<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingAjax extends FormRequest
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
            'dept_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'bookingType' => 'required|numeric',
            'roomType' => 'nullable|numeric',
            'numPple' => 'nullable|numeric',
            'chkInDate' => 'nullable|date|max:255',
            'chkOutDate' => 'nullable|date|max:255',
            'bookingAmountDue' => 'nullable|numeric',
            'modeOfPayment' => 'nullable|numeric',
            'transactionCode' => 'nullable',
            'bookingAmountReceived' => 'nullable|numeric',
            'paymentStatus' => 'nullable|numeric',
            'paymentDueDate' => 'nullable|date|max:255',
            'board' => 'nullable|numeric',
            'menu' => 'nullable|numeric',
            'menuDetails' => 'nullable',
            'meetingHall' => 'nullable',
            'tent' => 'nullable',
            'paSystem' => 'nullable',
            'projector' => 'nullable',
            //'firstName' => 'nullable|max:255',
            //'idNo' => 'nullable|numeric|digits_between:5,10',
            //'phoneNumber' => 'nullable|numeric|digits_between:10,15',
            //'email' => 'nullable|email|max:255',
        ];
    }
}
