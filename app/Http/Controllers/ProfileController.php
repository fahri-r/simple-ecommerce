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

    public function update(Request $request, $username)
    {
        $username = $request->cookie('username');
        $token = "Bearer {$request->cookie('token')}";

        $body = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
        ];

        $r = Request::create("/api/v1/profile/{$username}", 'PUT', $body);
        $r->headers->add(['Authorization' => $token]);

        $res = app()->handle($r);

        if ($res->getStatusCode() != 200) {
            return redirect()->back()->with('error', 'Failed to update the profile');
        }


        return redirect()->back()->with('success', 'Update profile succeed');
    }
}
