<?php

use App\Http\Controllers\BarangController; 
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/logout',[AuthenticationController::class,'logout']);
    Route::get('/me',[AuthenticationController::class,'me']);
    Route::post('/cart',[CartController::class,'store']);
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/checkout',[TransactionController::class,'store']);
    Route::get('/transaction',[TransactionController::class,'index']);
    Route::post('/barang',[BarangController::class,'store']);
    Route::patch('/barang/{id}',[BarangController::class,'update'])->middleware('barang-owner');
    Route::delete('/barang/{id}',[BarangController::class,'destroy'])->middleware('barang-owner');
});

Route::get('/barang',[BarangController::class,'index']);
Route::get('/barang/{id}',[BarangController::class,'show']);

Route::get('/category',[CategoryController::class,'index']);
Route::get('/category/{id}',[CategoryController::class,'show']);

Route::post('/login',[AuthenticationController::class,'login']);
Route::post('/register',[AuthenticationController::class,'register']);

Route::get('/storage/{filename}', [ImageController::class,'show']);