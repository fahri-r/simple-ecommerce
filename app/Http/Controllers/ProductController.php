<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/v1/products', 'GET');
        $res = app()->handle($request);
        $products = json_decode($res->getContent());

        return view('sections.products.index', [
            "products" => $products,
        ]);
    }

    public function show($id)
    {
        $request = Request::create("/api/v1/products/{$id}", 'GET');
        $res = app()->handle($request);
        $product = json_decode($res->getContent());

        if($res->getStatusCode() != 200) {
            return abort(404);
        }

        return view('sections.products.show', [
            "product" => $product
        ]);
    }
}
