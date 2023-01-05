<?php

namespace App\Services;

use App\Console\Kernel;
use App\Models\Keranjang;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;

class CheckoutService
{

    public function pay($request)
    {
        [$berat, $total, $detailBarang] = $this->getBeratAndTotal();
        [$ongkir, $estimasi]            = $this->getOngkir($request->kabupatenongkir, $berat, $request->code, $request->service);

        $detailBarang[] = [
            'id'        => 'ONGKIR',
            'price'     => $ongkir,
            'quantity'  => 1,
            'name'      => 'Biaya Ongkos Kirim'
        ];

        $transaction_details = [
            'order_id'      => Str::random(15),
            'gross_amount'  => $ongkir + $total
        ];

        $customer_details = array(
            'first_name'    => $request->nama_penerima,
            'address'       => $request->alamat,
            'city'          => $request->kecamatan,
            'postal_code'   => $request->kodepos,
            'phone'         => $request->telepon,
            'country_code'  => 'IDN'
        );


        $result                         = $this->checkout($detailBarang, $transaction_details, $customer_details);
        $result['data']['ongkir']       = $ongkir;
        $result['data']['total']        = $total;
        $result['data']['estimasi']     = $estimasi;

        return $result;
    }

    public function getBeratAndTotal()
    {

        $keranjangs = Keranjang::user()->get();
        $berat = 0;
        $total = 0;
        $itemDetails = [];
        foreach ($keranjangs as $keranjang) {
            $berat += $keranjang->produk->berat * $keranjang->jumlah;
            $total += $keranjang->produk->harga * $keranjang->jumlah;
            $itemDetails[] = [
                'id'        => $keranjang->produk->id_produk,
                'price'     => $keranjang->produk->harga,
                'quantity'  => $keranjang->jumlah,
                'name'      => substr($keranjang->produk->nama_produk, 0, 15)
            ];
        }

        return [$berat, $total, $itemDetails];
    }

    public function getOngkir($idkabupaten, $berat, $code, $service)
    {
        $ongkir     = 0;
        $estimasi   = 0;
        $biayaKirim = RajaOngkir::ongkosKirim([
            'origin'        => 501,     // ID kota/kabupaten asal
            'destination'   => $idkabupaten,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => $code    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        foreach ($biayaKirim as $biaya) {
            foreach ($biaya['costs'] as $key => $value) {
                if ($value['service'] == $service) {
                    $estimasi   =  $value['cost'][0]['etd'];
                    $ongkir     = $value['cost'][0]['value'];
                }
            }
        }

        return [$ongkir, $estimasi];
    }

    public function checkout($item_details, $transaction_details, $customerAddres)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Uncomment for production environment
        // Config::$isProduction = true;

        // Uncomment to enable sanitization
        // Config::$isSanitized = true;

        // Uncomment to enable 3D-Secure
        // Config::$is3ds = true;

        // Optional
        $customer_details = array(
            'first_name'        => auth()->user()->name,
            'email'             => auth()->user()->email,
            'billing_address'   => $customerAddres,
            'shipping_address'  => $customerAddres
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details'   => $transaction_details,
            'customer_details'      => $customer_details,
            'item_details'          => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return [
                'data'     => [
                    'token' => $snapToken
                ],
                'status'    => 200
            ];
        } catch (\Exception $e) {
            dd($e->getMessage());

            return [
                'token'     => '',
                'status'    => 500
            ];
        }
    }
}
