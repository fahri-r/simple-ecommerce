<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function index()
    {
        return view('sections.auth.login');
    }

    public function store(Request $request)
    {

        $body = [
            'username' => $request->username,
            'email' => $request->email,
        ];
        $request = Request::create('/api/v1/auth/login', 'POST', $body);
        $response = Route::dispatch($request);
        if ($response->getStatusCode() != 200) {
            return redirect()->back()->with('errors', 'Login failed');
        }

        $response_body = json_decode($response->getContent(), true);

        return redirect()->route('home.index')
            ->withCookies([
                'token' => cookie('token', $response_body['token'], 30, null, null, null, false),
                'username' => cookie('username', $response_body['user']['username'], 30, null, null, null, false)
            ]);
    }
}
