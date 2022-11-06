<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alamat'    => 'required',
            'kabupaten' => 'required|alpha',
            'kecamatan' => 'required|alpha',
            'kodepos'   => 'required|numeric',
            'telepon'   => 'required|numeric',
        ];
    }
}
