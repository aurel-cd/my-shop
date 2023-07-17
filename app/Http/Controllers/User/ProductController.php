<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();
        return view('user.userLandingPage', compact('categories', 'sizes', 'colors', 'brands'));
    }
    public function dashboard(){
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();
        $products = Product::with(['productEntries', 'images'])->get();

        foreach ($products as $product){

            $brand = Brands::where('id',$product['brands_id'])->first();
            $brandName = $brand['brandName'];
            $product['brandName'] = $brandName;
            foreach ($product->images as $image){
                $product['images'][] = $image;
            }
//   $images[]
//            dd($images[1]['image_name']);
            foreach ($product->productEntries as $productEntry) {
//                $entry = $productEntry;
                $size_id = $productEntry['size_id'];
                $color_id = $productEntry['color_id'];
            }
            $product['size'] =(Size::where('id', $size_id)->first())['size_value'];
            $product['color'] = (Color::where('id', $color_id)->first())['color_name'];

        }
        return view('user.dashboard', compact('products','categories', 'sizes', 'colors', 'brands'));
    }
}
