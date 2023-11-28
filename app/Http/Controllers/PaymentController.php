<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function edit(Request $request, $username, $orders, $payments)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $r = Request::create("/api/v1/profile/{$username}/orders/{$orders}/payments", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $payments = json_decode($res->getContent());

        return view('sections.payments.index', [
            'payments' => $payments->data,
            'order_id' => $orders,
            'username' => $username
        ]);
    }

    public function update(Request $request, $username, $orders, $payments)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $body = [
            'provider' => $request->provider,
            'amount' => $request->amount,
            'paid_status' => true,
        ];

        $r = Request::create("/api/v1/profile/{$username}/orders/{$orders}/payments/{$payments}", 'PUT', $body);
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);

        if ($res->getStatusCode() != 200) {
            return redirect()->route('home.index')->with('errors', 'Payment failed');
        }

        return redirect()->route('home.index')
            ->with('success', 'Payment succeed');
    }
}
