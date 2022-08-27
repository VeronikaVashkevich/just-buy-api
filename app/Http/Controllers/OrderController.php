<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class OrderController extends Controller
{
    /**
     * Create order
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $user = Auth::user();

        if ($user->cart()->count() === 0) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Cart is empty'
                ]
            ], 422);
        }

        $order = $user->orders()->create([
            'products' => $user->cart->pluck('product_id'),
            'order_price' => $user->cart->sum('product.price')
        ]);

        $user->cart()->delete();

        return response()->json([
            'data' => [
                'order_id' => $order->id,
                'message' => 'Order is processed',
            ]
        ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        return response()->json([
            'data' => OrderResource::collection(Auth::user()->orders),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
