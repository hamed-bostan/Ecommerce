<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index()
    {

        return Orders::paginate(2);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'amount'=>['required'],
            'name'=>['required','string','max:255'],
        ]);

        if ($validate->fails()){
            return response()->json([
                'message'=>'Invalid input.',
            ]);
        }

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
        $order->update($request->all());

        return response()->json([
            'message'=>'updating was successful',
        ]);

    }
}
