<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return CategoryResource::collection($category);
    }

    public function show($id){
        $categoryWithProducts = Category::with('barang')->findOrFail($id);
        return response()->json($categoryWithProducts);
    }
}
