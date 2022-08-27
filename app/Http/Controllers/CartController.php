<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add product to cart
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Product $product)
    {
        $user = Auth::user();

        $user->cart()->create([
            'product_id' => $product->id,
        ]);

        return response()->json([
            'date' => [
                'message' => 'Product added to cart'
            ]
        ], 201);
    }

    public function show()
    {
        return CartResource::collection(Auth::user()->cart);
    }

    
}
