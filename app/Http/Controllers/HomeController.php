<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/products', 'GET');
        $response = Route::dispatch($request);
        $data = json_decode($response->getContent(), true);

        return view('sections.home.index', ["products" => $data['data']]);
    }
}
