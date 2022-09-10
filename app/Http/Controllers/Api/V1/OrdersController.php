<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckEmailIsVerified;
use App\Http\Requests\OrderRequest;
use \App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Policies\OrderPolicy;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function response;

class OrdersController extends Controller
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
//        return Order::paginate(10);
//        $order = Order::find();
//        return new OrderResource($order);
        return OrderResource::collection(Order::all());
    }

    public function store(OrderRequest $request)
    {

//         Order::create([$request->validated()]);
        $order = $this->orderRepository->create($request->validated());

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
