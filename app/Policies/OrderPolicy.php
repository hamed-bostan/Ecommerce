<?php

namespace App\Policies;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Orders $order)
    {
        return Orders::all();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Request $request,User $user)
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

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Request $request,Orders $order)
    {
//        $order->update($request->all());
            $order->update($request->all());
        return response()->json([
            'message'=>'updating was successful',
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Orders $orders)
    {
        //
    }
}
