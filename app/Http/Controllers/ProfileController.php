<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $r = Request::create("/api/v1/profile/", 'GET');
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);

        if ($res->getStatusCode() != 200) {
            return redirect()->route('login.index');
        }


        $profile = json_decode($res->getContent());
        return view('sections.profile.index', [
            'profile' => $profile
        ]);
    }
}
