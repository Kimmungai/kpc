<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBooking extends FormRequest
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
          'numPple' => 'required|numeric',
          'dept_rooms_id' => 'nullable|numeric',
          'chkInDate' => 'required|date|max:255',
          'chkOutDate' => 'nullable|date|max:255',
          'bookingAmountDue' => 'nullable|numeric',
          'modeOfPayment' => 'nullable|numeric',
          'transactionCode' => 'nullable',
          'bookingAmountReceived' => 'nullable|numeric',
          'paymentDueDate' => 'nullable|date|max:255',
        ];
    }
}
