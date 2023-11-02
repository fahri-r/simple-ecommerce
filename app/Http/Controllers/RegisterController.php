<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    public function index()
    {
        return view('sections.auth.register');
    }

    public function store(Request $request)
    {

        $body = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role ?? UserRoleEnum::USER,
        ];
        $request = Request::create('/api/v1/auth/register', 'POST', $body);
        $response = Route::dispatch($request);
        $response_body = json_decode($response->getContent(), true);

        return redirect()->route('home.index')
            ->withCookies([
                'token' => cookie('token', $response_body['token'], 30, null, null, null, false),
                'username' => cookie('username', $response_body['user']['username'], 30, null, null, null, false)
            ]);
    }
}
