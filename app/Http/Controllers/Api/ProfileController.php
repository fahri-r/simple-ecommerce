<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use App\Models\Profile;
use stdClass;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role == UserRoleEnum::USER) {
            $data = Profile::where('user_id', $user->id)->limit(1)->get()->first();

            return response()->json([
                "success" => true,
                "message" => "Profile retrieved successfully.",
                "data" => new ProfileResource($data)
            ]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $per_page = $request->has('per_page') ? (int) $request->input('per_page') : 10;
        $data = Profile::paginate($per_page, ['*'], 'page', $page);
        $return_data = ProfileResource::collection($data->items());

        return response()->json([
            'success' => true,
            "data" => $return_data,
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'page' => $data->currentPage(),
        ]);
    }

    public function show($username)
    {
        if (auth()->user()->role == UserRoleEnum::USER && auth()->user()->username != $username) {
            return response()->json([
                "success" => false,
                "message" => "Profile can't be accessed",
                "data" => new stdClass()
            ], 403);
        }

        $data = Profile::whereHas('user', function ($user) use ($username) {
            $user->where('username', $username);
        })->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Profile not found.",
                "data" => new stdClass()
            ], 404);
        }


        return response()->json([
            "success" => true,
            "message" => "Profile retrieved successfully.",
            "data" => new ProfileResource($data)
        ]);
    }


    public function update(UpdateProfileRequest $request, $username)
    {
        if (auth()->user()->role == UserRoleEnum::USER && auth()->user()->username != $username) {
            return response()->json([
                "success" => false,
                "message" => "Profile can't be accessed",
                "data" => new stdClass()
            ], 403);
        }

        $data = Profile::whereHas('user', function ($user) use ($username) {
            $user->where('username', $username);
        })->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Profile not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();
        $validated = $request->safe();

        $data->first_name = $validated->first_name;
        $data->last_name = $validated->last_name;
        $data->address = $validated->address;
        $data->city = $validated->city;
        $data->postal_code = $validated->postal_code;
        $data->phone = $validated->phone;
        $data->save();

        return response()->json([
            "success" => true,
            "message" => "Profile updated successfully.",
            "data" => new ProfileResource($data)
        ]);
    }


    public function destroy($username)
    {
        if (auth()->user()->role == UserRoleEnum::USER && auth()->user()->username != $username) {
            return response()->json([
                "success" => false,
                "message" => "Profile can't be accessed",
                "data" => new stdClass()
            ], 403);
        }

        $data = Profile::whereHas('user', function ($user) use ($username) {
            $user->where('username', $username);
        })->get()->first();
        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Profile not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Profile deleted successfully.",
            "data" => new ProfileResource($data)
        ]);
    }
}
