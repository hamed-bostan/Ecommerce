<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {

        return Orders::all();
    }


    public function store(Request $request)
    {
        $order = new Orders([
            'amount'=>$request->amount,
            'name'=>$request->name,
        ]);

        $order->save();

        return response()->json([
            'message'=>'Creating was successful'
        ]);
    }


    public function update(Request $request,Orders $order)
    {
//        $order->update([
//            'amount'=>$request->input('amount'),
//            'name'=>$request->input('name'),
//        ]);

        // $order->save();


        $order->update($request->all());

        return response()->json([
            'message'=>'updating was successful',
        ]);


    }
}
