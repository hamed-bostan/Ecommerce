<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckEmailIsVerified;
use App\Models\Order;
use App\Models\Product;
use App\Policies\OrderPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class OrdersController extends Controller
{

    //index
    public function index()
    {
        return Order::paginate(10);
    }

    //store
    public function store(Request $request)
    {
        $validate = $request->validate([
            'total_price' => ['required'],
            'total_of_orders' => ['required'],
            'user_id' => ['required'],
            'product_id' => ['required'],
        ]);

        if (! $validate) {
            return response()->json([
                'message' => 'Invalid input.',
            ]);
        }

        $order = Order::create([
            'total_price' => $request->total_price,
            'total_of_orders' => $request->total_of_orders,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,

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
