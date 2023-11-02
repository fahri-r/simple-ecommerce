<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";
        
        $r = Request::create("/api/v1/profile/", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $profile = json_decode($res->getContent());

        $r = Request::create("/api/v1/profile/{$username}/carts", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);
        $carts = json_decode($res->getContent());

        return view('sections.checkout.index', [
            'carts' => $carts,
            'profile' => $profile
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
    // public function store(Request $request)
    // {
    //     $username = $request->cookie('username');
    //     $token = "Bearer {$request->cookie('token')}";

    //     $body = [
    //         'product_id' => $request->product_id,
    //         'quantity' => 1,
    //     ];

    //     $r = Request::create("/api/profile/{$username}/carts", 'POST', $body);
    //     $r->headers->add(['Authorization' => $token]);

    //     return back();
    // }

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
