<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'qty' => 'required'
        ]);

        
        $user = Auth::user();

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->barang_id = $request->barang_id;
        $cart->qty = $request->qty;
        $cart->save();
        return response()->json($cart);
    }


    public function index()
{
    $user = Auth::user();
    $carts = Cart::with('barang')->where('user_id', $user->id)->get();
    return response()->json($carts);
}
}
