<?php

namespace App\Http\Middleware;

use App\Models\Barang;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BarangOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $barang = Barang::findOrFail($request->id);
        if ($barang->user_id != $currentUser->id){
            return response()->json(['message'=>'Data not found'],404);
        }
        return $next($request);
    }
}
