<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use \App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Policies\OrderPolicy;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function store(Order $order, Request $request)
    {



//         Order::create([$orderRequest->validated()]);
//        $order = $this->orderRepository->create($orderRequest->validated());


        //  Logics are here

        $product = Product::findOrFail( $request -> product_id);
        if ($product->has_min){
            if ($product -> min > $order -> orders_count ){
                return response()->json([
                    'message' => ' You can not buy this item less than 3 times.'
                ]);
            }
        }

        if ($product -> has_max){
            if ($product->max < $order -> orders_count ){
                return response()->json([
                    'message' => ' You can not buy this item more than 10 times per each order.'
                ]);
            }
        }

        $order = Order::select(DB::raw('sum(orders_count) as sum_orders_count'))->where('user_id', $request->user_id)->where('created_at', '>', now()->addDays(-30))->first();

        if (($order->sum_orders_count + $request->orders_count) > $product->max_count_per_month)
            return response(['message' => 'You can not buy this item more than 50 times a month.'], 500);


//            $order = Order::create($request->all());
//            return response()->json([
//               'message'=> 'Order was successful',
//                'Order' => $order
//            ]);


        Order::create([$orderRequest->validated()]);
        $order = $this->orderRepository->create($orderRequest->validated());



        //  Logics ends


//        $order->save();

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

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }


    public function ordering(Order $order)
    {
        $user = auth()->user();
        $number_of_order = 60;

        if ($number_of_order > 50 ){
            return 'you cant';
        }
        $today= Carbon::now();
        $last_month= Carbon::now()->subDays(30);
        $buying = Order::where('created_at','>=',$last_month)->get();
//        if ()
//        dd($buying);
    }

}
