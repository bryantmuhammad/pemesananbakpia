<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;

use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    private $checkout_service;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkout_service = $checkoutService;
    }

    public function pay(CheckoutRequest $request)
    {
        $result = $this->checkout_service->pay($request);

        return response()->json($result, $result['status']);
    }
}
