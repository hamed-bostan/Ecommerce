<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Http\Request;
use function response;

class ProductController extends Controller
{
    //index
    public function index()
    {
        return Product::paginate(10);
    }

    //store
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_name' => ['required'],
            'color' => ['required'],
            'price' => ['required'],
            'is_available_in_store' => ['required'],
            'quantity' => ['required'],
            'user_id' => ['required'],
        ]);

        if (! $validate) {
            return response()->json([
                'message' => 'Invalid input.',
            ]);
        }

        $order = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'is_available_in_store' => $request->is_available_in_store,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'user_id' => $request->user_id,

        ]);

        $order->save();

        return response()->json([
            'message' => 'Creating was successful'
        ]);
    }


    public function update(Request $request, Order $order)
    {
        $this->authorize(ProductPolicy::UPDATE, $order);

        $order->update($request->all());

        return response()->json([
            'message' => 'updating was successful',
        ]);
    }
}
