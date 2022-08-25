<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Config;
use Midtrans\Snap;

class OngkirController extends Controller
{
    public function provinsi()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();

        return response()->json($daftarProvinsi);
    }

    public function kabupaten(Request $request)
    {
        $kabupaten = RajaOngkir::kota()->dariProvinsi($request->idprovinsi)->get();

        return response()->json($kabupaten);
    }

    public function ongkir(Request $request)
    {
        // return $request;
        $daftarProvinsi = RajaOngkir::ongkosKirim([
            'origin'        => 501,     // ID kota/kabupaten asal
            'destination'   => $request->idkabupaten,      // ID kota/kabupaten tujuan
            'weight'        => $request->berat,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $pengiriman = [
            [
                'code' => $daftarProvinsi[0]['code'],
                'costs' => $daftarProvinsi[0]['costs']
            ]
        ];

        return response()->json($pengiriman);
    }

    public function pay()
    {


        Config::$serverKey = 'SB-Mid-server-tXQghur1Os4q-Pu0R8Lvczsp';

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Uncomment to enable sanitization
        // Config::$isSanitized = true;

        // Uncomment to enable 3D-Secure
        // Config::$is3ds = true;

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 145000, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => 50000,
            'quantity' => 2,
            'name' => "Apple"
        );

        // Optional
        $item2_details = array(
            'id' => 'a2',
            'price' => 45000,
            'quantity' => 1,
            'name' => "Orange"
        );

        // Optional
        $item_details = array($item1_details, $item2_details);

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
            dd($paymentUrl);

            // Redirect to Snap Payment Page
            return redirect()->away('https://www.google.com');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
