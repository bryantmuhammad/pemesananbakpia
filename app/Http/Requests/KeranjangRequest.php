<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeranjangRequest extends FormRequest
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

        $rules = [
            'jumlah'    => 'required|min:1',
        ];

        if ($this->method() == 'POST')  $rules['id_produk'] = 'required|exists:produks,id_produk';

        return $rules;
    }
}
