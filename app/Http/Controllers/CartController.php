<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }


    public function store(Request $request)
    {
        $order = 0;
        $order = $order + 1;
        return $order;
    }
}
