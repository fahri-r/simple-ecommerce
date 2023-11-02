<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe();

        $user = User::create([
            'username' => $validated->username,
            'email' => $validated->email,
            'password' => bcrypt($validated->password),
            'role' => $validated->role ?? UserRoleEnum::USER,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'first_name' => $validated->first_name,
            'last_name' => $validated->last_name,
        ]);

        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    }


    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe();

        $data = [
            'email' => $validated->email,
            'password' => $validated->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            return response()->json([
                'user' => new UserResource(auth()->user()),
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
