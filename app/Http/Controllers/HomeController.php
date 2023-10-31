<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/products', 'GET', [
            'random' => false,
            'per_page' => 2
        ]);
        $res = app()->handle($request);
        $data = json_decode($res->getContent());

        return view('sections.home.index', ["products" => $data->data]);
    }
}
