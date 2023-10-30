<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = Profile::where('user_id', $user->id)->limit(1)->get()->first();

        return response()->json([
            "success" => true,
            "message" => "Profile retrieved successfully.",
            "data" => new ProfileResource($data)
        ]);
    }
}
