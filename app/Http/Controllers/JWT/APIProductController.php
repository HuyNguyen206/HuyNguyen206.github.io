<?php

namespace App\Http\Controllers\JWT;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class APIProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    function getAllCategory()
    {
        $category = Category::all();
       return response()->json(['data' => $category, 'code' => 200]);
    }

    function getProductByCategory($id)
    {
        $product = Category::find($id)->products;
        return response()->json(['data' => $product, 'code' => 200]);
    }

    function getProductByID($id)
    {
        $product = Product::find($id);
        return response()->json(['data' => $product, 'code' => 200]);
    }
}
