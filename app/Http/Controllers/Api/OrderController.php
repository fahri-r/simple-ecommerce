<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
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
        $data = Order::whereRelation('details', 'profile_id', $profile_data->id)->paginate($per_page, ['*'], 'page', $page);
        $return_data = OrderResource::collection($data);

        return response()->json([
            'success' => true,
            "data" => $return_data,
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'page' => $data->currentPage(),
        ]);
    }


    public function store(Request $request, $profile)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();
        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $cart = Cart::where('profile_id', $profile_data->id);
        $cart_data = $cart->get();
        $price_total = $cart_data->sum(function ($item) {
            return $item->price();
        });

        $payment = Payment::create([
            'amount' => 0,
            'provider' => '',
            'paid_status' => false,
        ]);

        $order = Order::create([
            'profile_id' => $profile_data->id,
            'payment_id' => $payment->id,
            'price_total' => $price_total,
        ]);

        $order_items = [];
        foreach ($cart_data as $c) {
            array_push($order_items, [
                'order_id' => $order->id,
                'product_id' => $c->product_id,
                'quantity' => $c->quantity,
            ]);
        }

        $order->details()->createMany($order_items);
        $cart->delete();

        return response()->json([
            "success" => true,
            "message" => "Order created successfully.",
            "data" => new OrderResource($order)
        ], 201);
    }


    public function show($profile, $order)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Order::where('profile_id', $profile_data->id)->where('id', $order)->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Order not found.",
                "data" => new stdClass()
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Order retrieved successfully.",
            "data" => new OrderResource($data)
        ]);
    }


    public function update(UpdateOrderRequest $request, $profile, $cart)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Order::where('profile_id', $profile_data->id)->where('id', $cart)->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Order not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();
        $validated = $request->safe();

        $data->price_total = $validated->price_total;
        $data->save();

        return response()->json([
            "success" => true,
            "message" => "Order updated successfully.",
            "data" => new OrderResource($data)
        ]);
    }


    public function destroy($profile, $order)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Order::where('profile_id', $profile_data->id)->where('id', $order)->get()->first();
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
            "data" => new OrderResource($data)
        ]);
    }
}
