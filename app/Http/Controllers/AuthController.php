<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('sections.auth.login');
    }

    public function register()
    {
        return view('sections.auth.register');
    }

    public function createUser (Request $request) {
        dd($request);
    }
}
