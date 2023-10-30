<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Profile;
use Illuminate\Http\Request;
use stdClass;

class CartController extends Controller
{
    public function index(Request $request, $profile)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $per_page = $request->has('per_page') ? (int) $request->input('per_page') : 10;
        $data = Cart::where('profile_id', $profile_data->id)->paginate($per_page, ['*'], 'page', $page);
        $return_data = CartResource::collection($data->items());

        return response()->json([
            'success' => true,
            "data" => $return_data,
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'page' => $data->currentPage(),
        ]);
    }


    public function store(StoreCartRequest $request, $profile)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();
        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();

        $data = Cart::create([
            'profile_id' => $profile_data->id,
            'product_id' => $validated->product_id,
            'quantity' => $validated->quantity,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Cart created successfully.",
            "data" => new CartResource($data)
        ], 201);
    }


    public function show($profile, $cart)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Cart::where('profile_id', $profile_data->id)->where('id', $cart)->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Cart not found.",
                "data" => new stdClass()
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Cart retrieved successfully.",
            "data" => new CartResource($data)
        ]);
    }


    public function update(UpdateCartRequest $request, $profile, $cart)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Cart::where('profile_id', $profile_data->id)->where('id', $cart)->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Cart not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();
        $validated = $request->safe();

        $data->product_id = $validated->product_id;
        $data->quantity = $validated->quantity;
        $data->save();

        return response()->json([
            "success" => true,
            "message" => "Cart updated successfully.",
            "data" => new CartResource($data)
        ]);
    }


    public function destroy($profile, $cart)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Cart::where('profile_id', $profile_data->id)->where('id', $cart)->get()->first();
        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Product not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => new CartResource($data)
        ]);
    }
}
