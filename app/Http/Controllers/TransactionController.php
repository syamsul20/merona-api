<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items.*.barang_id' => 'required',
            'items.*.qty' => 'required'
        ]);

        
        $user = Auth::user();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->nama = $request->nama;
        $transaction->email = $request->email;
        $transaction->phone = $request->phone;
        $transaction->alamat = $request->alamat;
        $transaction->kota = $request->kota;
        $transaction->kurir = $request->kurir;
        $transaction->payment_method = $request->payment_method;
        $transaction->total_amount = $request->total_amount;
        $transaction->fee = $request->fee;
        $transaction->save();
        foreach ($request->items as $item) {
            $transaction_item = new TransactionItem();
            $transaction_item->barang_id = data_get($item,'barang_id');
            $transaction_item->qty = data_get($item,'qty');
            $transaction_item->transaction_id = $transaction->id;
            $transaction_item->save();
            Cart::where('user_id',$user->id)->where('barang_id',data_get($item,'barang_id'))->delete();
        }

        $data = Transaction::where('id',$transaction->id)->first();
        
        return response()->json($data->load('items'));
    }

    public function index()
    {
        $user = Auth::user();
        $data = Transaction::where('user_id',$user->id)->get();
        return response()->json($data->load('items.barang'));
    }
}
