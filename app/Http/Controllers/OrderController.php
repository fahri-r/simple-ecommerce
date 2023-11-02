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
        //
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
}
