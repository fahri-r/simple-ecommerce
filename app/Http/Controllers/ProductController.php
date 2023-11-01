<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/products', 'GET');
        $res = app()->handle($request);
        $products = json_decode($res->getContent());

        return view('sections.products.index', [
            "products" => $products,
        ]);
    }

    public function show($id)
    {
        return view('sections.products.show');
    }
}
