<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnProdukRequest extends FormRequest
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
            'jumlah'                => ['required', 'numeric'],
            'url'                   => ['required'],
            'alasan'                => ['required'],
            'id_detail_pemesanan'   => ['required', 'exists:detail_pemesanans,id_detail_pemesanan'],
            'id_produk'             => ['required', 'exists:produks,id_produk']
        ];
    }
}
