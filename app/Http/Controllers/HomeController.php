<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/v1/products', 'GET', [
            'per_page' => 8
        ]);
        $res = app()->handle($request);
        $products = json_decode($res->getContent());


        $request = Request::create('/api/v1/products', 'GET', [
            'per_page' => 8,
            'random' => true
        ]);
        $res = app()->handle($request);
        $random_products = json_decode($res->getContent());

        return view('sections.home.index', [
            "products" => $products,
            "random_products" => $random_products
        ]);
    }
}
