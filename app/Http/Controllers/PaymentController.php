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

    public function success(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ])->send();

            if ($transaction->isSuccessful()) {
                $arr = $transaction->getData();

                // Save payment info
                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'payment_id' => $arr['id'],
                    'payer_id' => $arr['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr['payer']['payer_info']['email'],
                    'status' => $arr['state'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'user_id' => Auth::id(),
                ]);

                $booking->update(['status' => 'paid']);

                return redirect()->route('bookings.show', $booking->id)->with('success', 'Payment successful!');
            } else {
                return redirect()->route('bookings.show', $booking->id)->with('error', $transaction->getMessage());
            }
        } else {
            return redirect()->route('bookings.show', $booking->id)->with('error', 'Payment declined or cancelled.');
        }
    }

   
}