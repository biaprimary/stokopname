<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            //
            'id_buyer' => 'required',
            'id_item' => 'required',
            'qty' => 'numeric|min:0'
        ];
    }

    public function messages()
    {
      return [
          //
          'id_buyer.required'=>'Buyer is Required',
          'id_item.required'=>'Item is Required',
          'qty.min'=>'Quantity is Required',
      ];
    }
}
