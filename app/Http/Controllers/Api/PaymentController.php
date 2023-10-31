<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\Request;
use stdClass;

class PaymentController extends Controller
{
    public function index(Request $request, $profile, $order)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }


        $data = Payment::whereRelation('order', 'profile_id', $profile_data->id)
            ->whereRelation('order', 'id', $order)
            ->get()->first();

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Payment not found.",
                "data" => new stdClass()
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Payment retrieved successfully.",
            "data" => new PaymentResource($data)
        ]);
    }


    public function update(UpdatePaymentRequest $request, $profile, $order, $payment)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Payment::whereRelation('order', 'profile_id', $profile_data->id)
            ->whereRelation('order', 'id', $order)
            ->get()->first();

        if (is_null($data) || $data->id != (int) $payment) {
            return response()->json([
                "success" => false,
                "message" => "Payment not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();
        $validated = $request->safe();

        $data->amount = $validated->amount;
        $data->provider = $validated->provider;
        $data->paid_status = $validated->paid_status;
        $data->save();

        return response()->json([
            "success" => true,
            "message" => "Payment updated successfully.",
            "data" => new PaymentResource($data)
        ]);
    }


    public function destroy($profile, $order, $payment)
    {
        $profile_data = Profile::whereRelation('user', 'username', $profile)->get()->first();

        if (is_null($profile_data)) {
            return response()->json([
                "success" => false,
                "message" => "Username not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data = Payment::whereRelation('order', 'profile_id', $profile_data->id)
            ->whereRelation('order', 'id', $order)
            ->get()->first();

        if (is_null($data) || $data->id != (int) $payment) {
            return response()->json([
                "success" => false,
                "message" => "Payment not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Payment deleted successfully.",
            "data" => new PaymentResource($data)
        ]);
    }
}
