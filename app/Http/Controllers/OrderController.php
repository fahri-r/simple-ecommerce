<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $r = Request::create("/api/v1/profile/{$username}/orders", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $orders = json_decode($res->getContent());


        // $details = ['title' => 'test'];
        // $pdf = Pdf::loadView('sections.orders.index', $details)->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('invoice.pdf');
        return view('sections.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $body = [];

        $r = Request::create("/api/v1/profile/{$username}/orders", 'POST', $body);
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $order = json_decode($res->getContent());

        if ($res->getStatusCode() != 201) {
            return redirect()->route('home.index')->with('errors', 'Failed to create order');
        }

        return redirect()->route('profile.orders.payments.edit', [
            'profile' => $username,
            'orders' => $order->data->id,
            'payments' => $order->data->payment->id
        ])
            ->with('success', 'Create order successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function invoice(Request $request, $id)
    {

        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $r = Request::create("/api/v1/profile/{$username}/orders/{$id}/invoice", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $orders = json_decode($res->getContent());

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($res->getContent(), 'filename.pdf', $headers);
    }
}
