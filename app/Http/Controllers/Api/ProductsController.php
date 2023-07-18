<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showProducts(){
        $products = Product::with(['productEntries','images'])->get();
        return $products;
    }

    public function showProduct(Product $product){
        return $product;
    }
}
