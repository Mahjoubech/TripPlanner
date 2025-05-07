<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); 
    }

    public function pay(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $response = $this->gateway->purchase([
            'amount' => $booking->trip->price,
            'currency' => 'USD',
            'returnUrl' => route('payments.success', $booking->id),
            'cancelUrl' => route('payments.cancel', $booking->id),
        ])->send();

        if ($response->isRedirect()) {
            return redirect()->away($response->getRedirectUrl());
        } else {
            return back()->with('error', $response->getMessage());
        }
    }

  
}