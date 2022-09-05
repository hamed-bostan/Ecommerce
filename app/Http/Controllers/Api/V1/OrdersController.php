<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckEmailIsVerified;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Policies\OrderPolicy;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if (!$validate) {
            return response()->json([
                'message' => 'Invalid input.',
            ]);
        }

//        $admin = User::where('is_admin',1)->get();

        $admin = DB::table('users')->where('is_admin', '=', true)->get();

        if ( !$admin ) {
            return response()->json([
                'message'=>'not admin',
            ]);
        }
        else{
            return response()->json([
                'message'=>'is admin',
            ]);
        }
//        $order = Order::create([
//            'total_price' => $request->total_price,
//            'total_of_orders' => $request->total_of_orders,
//            'user_id' => $request->user_id,
//            'product_id' => $request->product_id,
//
//        ]);
//
//        $order->save();
//
//        return response()->json([
//            'message' => 'Creating was successful'
//        ]);


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
