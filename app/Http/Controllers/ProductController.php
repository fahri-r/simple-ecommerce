<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('sections.products.index');
    }

    public function show($id)
    {
        return view('sections.products.show');
    }
}
