<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cart::all();
        return response()->json([
            'status' => true,
            'message' => 'Get all cart items successfully',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, [
            'quantity' => 'required',
            'cake_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $cart = Cart::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Create Data Successfully',
            'data' => $cart
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => '$cart not found',
                'data' => $cart
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get detail data successfully',
            'data' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'item not found',
                'data' => null
            ], 404);
        }
        $cart->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Update data Successfully',
            'data' => $cart
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'item not found',
                'data' => null
            ], 404);
        }
        $cart->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete data Successfully',
            'data' => null
        ]);
    }
}
