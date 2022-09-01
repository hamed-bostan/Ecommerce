<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckEmailIsVerified;
use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class OrdersController extends Controller
{

    //index
    public function view()
    {
        return Order::paginate(2);
    }

    //store
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'quantity'     => ['required'],
            'price'        => ['required'],
            'product_name' => ['required', 'string', 'max:255'],
            'user_id'      => ['required'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Invalid input.',
            ]);
        }

        $order = new Order([
            'quantity'     => $request->quantity,
            'price'        => $request->price,
            'product_name' => $request->product_name,
            'user_id'      => $request->user_id,
        ]);

        $order->save();

        return response()->json([
            'message' => 'Creating was successful'
        ]);
    }


    public function update(Request $request, Order $order)
    {
        $this->authorize(OrderPolicy::UPDATE, $order);

        $order->update($request->all());

        return response()->json([
            'message' => 'updating was successful',
        ]);
    }
}
