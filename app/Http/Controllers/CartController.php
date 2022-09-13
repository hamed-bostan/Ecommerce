<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return 'Index works';
    }


    public function store(Cart $cart, Request $request)
    {
        Cart::find(13);


//        $user = auth()->user();
        $c = DB::update(
            'update carts set number_of_orders = 1 where id = ?',
            [13]
        );


        $cart = DB::table('carts')->get();

        return $cart;
    }

    public function addToCart(AddToCartRequest $request)
    {
        // If you are an admin you can change other users' basket.

//        $cart = auth()->user()->cart;
//        if ($cart === null) {
//            Cart::create(['user_id' => auth()->id()]);
//        }

        $data = $request->validated();
        $cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);
//        $cart->cartDetails()->crearteOrUpdate(
//            ['product_id' => $data['product_id']],
//            ['quantity' => $data['quantity']]
//        );

        // softDelete

        $cartDetail = $cart->cartDetails()->where(['product_id' => $data['product_id']])->first();
        if ($data['quantity'] == 0 && $cartDetail) {
            $cartDetail->delete();

            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        if ($cartDetail instanceof CartDetail === false) {
            $cart->cartDetails()->create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity']
            ]);
        } else {
            $cartDetail->update(['quantity' => $data['quantity']]);
        }

        return new CartResourece($cart->load('cartDetail')); // whenLoaded
    }

    /**
     *
     * min_quantity // each order, nullable
     * max_quantity // each order, nullable
     * max_quantity_for_user // FOr example for checking the last month, nullable
     * Order::where(user_id , auth()->id())->
     *
     *
     *
     */

}
