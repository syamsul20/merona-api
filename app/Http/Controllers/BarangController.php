<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangDetailResource;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return BarangResource::collection($barangs);
    }

    public function show($id)
    {
        $barang = Barang::with(['category', 'user'])->findOrFail($id);
        return new BarangDetailResource($barang);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $timestamp = time();
        $imageName = 'product-' . $timestamp;
        $extension = $request->image->extension();
        $imagePath = $request->image->storeAs(
            'public/images',
            $imageName . '.' . $extension
        );

        $user = Auth::user();

        $barang = new Barang();
        $barang->nama = $request->nama;
        $barang->description = $request->description;
        $barang->price = $request->price;
        $barang->category_id = $request->category_id;
        $barang->user_id = $user->id;
        $barang->image = $imagePath;
        $barang->save();
        return new BarangDetailResource(
            $barang->loadMissing('user')->loadMissing('category')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return new BarangDetailResource(
            $barang->loadMissing('user')->loadMissing('category')
        );
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return new BarangDetailResource(
            $barang->loadMissing('user')->loadMissing('category')
        );
    }

    function generateRandomString($length = 30)
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
