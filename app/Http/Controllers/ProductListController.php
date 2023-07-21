<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductListController extends Controller
{
    public function dashboard(Request $request)
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();

        $products = Product::with(['productEntries', 'images'])->paginate(4);

            foreach ($products as $product) {
                $brand = Brands::where('id', $product['brands_id'])->first();
                $brandName = $brand['brandName'];
                $product['brandName'] = $brandName;
                foreach ($product->images as $image) {
                    $product['images'][] = $image;
                }

                if(empty($product->productEntries)) {
                    foreach ($product->productEntries as $productEntry) {
//                $entry = $productEntry;
                        $size_id = $productEntry['size_id'];
                        $color_id = $productEntry['color_id'];
                    }
                    $product['size'] = (Size::where('id', $size_id)->first())['size_value'];
                    $product['color'] = (Color::where('id', $color_id)->first())['color_name'];

                }else {
                    $product['size'] = 'No size available';
                    $product['color'] = 'No color available';
                }
            }
            return view('welcome', compact('products', 'categories', 'sizes', 'colors', 'brands'));
    }

    public function filteredProducts(Request $request)
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();


        $brandId = $request->input('brand_id');
        $sizeId = $request->input('size_id');
        $colorId = $request->input('color_id');
        $selectedProduct = $request->selectedProductName;
        $query = Product::with(['productEntries', 'images']);

        if ($selectedProduct) {
            $query->where('id','like','%'.$selectedProduct.'%');
        }

        if ($brandId) {
            $query->where('brands_id', $brandId);
        }
        if ($sizeId) {
            $query->whereHas('productEntries', function ($query) use ($sizeId) {
                $query->where('size_id', $sizeId);
            });
        }

        if ($colorId) {
            $query->whereHas('productEntries', function ($query) use ($colorId) {
                $query->where('color_id', $colorId);
            });
        }

        if ($request) {
            $products = $query->paginate(4);
        } else {
            $products = Product::with(['productEntries', 'images'])->paginate(4);
        }

        foreach ($products as $product) {
            $brand = Brands::where('id', $product['brands_id'])->first();
            $brandName = $brand['brandName'];
            $product['brandName'] = $brandName;
            foreach ($product->images as $image) {
                $product['images'][] = $image;
            }

            foreach ($product->productEntries as $productEntry) {
                $size_id = $productEntry['size_id'];
                $color_id = $productEntry['color_id'];
            }
            $product['size'] = (Size::where('id', $size_id)->first())['size_value'];
            $product['color'] = (Color::where('id', $color_id)->first())['color_name'];
        }


        $filteredView = view('filteredProducts', compact('products', 'categories', 'sizes', 'colors', 'brands'))->render();



        if($request->ajax()) {
            return response()->json([
                'data' => $filteredView,
                'pagination' => $products->links()->toHtml()
            ]);
        }
        return view('welcome', compact('products', 'categories', 'sizes', 'colors', 'brands'));
    }



    public function selectedProduct(Request $request)
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();

        $selectedProduct = $request->selectedProductName;
        $query = Product::with(['productEntries', 'images']);

        if ($selectedProduct) {
            $query->where('id','like','%'.$selectedProduct.'%');
        }

        if ($request) {
            $products = $query->paginate(4);
        } else {
            $products = Product::with(['productEntries', 'images'])->paginate(4);
        }
        foreach ($products as $product) {

            $brand = Brands::where('id', $product['brands_id'])->first();
            $brandName = $brand['brandName'];
            $product['brandName'] = $brandName;
            foreach ($product->images as $image) {
                $product['images'][] = $image;
            }
//   $images[]
//            dd($images[1]['image_name']);

            foreach ($product->productEntries as $productEntry) {
//                $entry = $productEntry;
                $size_id = $productEntry['size_id'];
                $color_id = $productEntry['color_id'];
            }
            $product['size'] = (Size::where('id', $size_id)->first())['size_value'];
            $product['color'] = (Color::where('id', $color_id)->first())['color_name'];

        }
//        dd($products);
//            return view('welcome', compact('products', 'categories', 'sizes', 'colors', 'brands'));
        // Retrieve and manipulate the data

        return response()->json(['data'=>view('filteredProducts', compact('products', 'categories', 'sizes', 'colors', 'brands'))->render()]);
    }


    public function getProductNames(Request $request){
            $products = Product::where('product_name','like','%'.$request->searchItem.'%')->with(['productEntries', 'images'])->get();
            return $products;
        }

    public function productInfo($id)
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();
        $product = Product::where('id', $id)->with(['productEntries', 'images'])->first();

        $brand = Brands::where('id', $product->brands_id)->first();
        $brandName = $brand->brandName;
        $product->brandName = $brandName;
        foreach ($product->images as $image) {
            $product->images[] = $image;
        }
        $quantity = 0;
        $availableSizes = [];
        $availableColors = [];
        foreach ($product->productEntries as $productEntry) {
            $size = Size::where('id', $productEntry->size_id)->first();
            $color = Color::where('id', $productEntry->color_id)->first();

            if ($size) {
                $availableSizes[] = $size;
            }

            if ($color) {
                $availableColors[] = $color;
            }
            if($quantity) {
                $quantity = $productEntry['quantity'];
            }
        }

        foreach ($product->images as $image){
            $product['images'][] = $image;
        }

        return view('productInfo', compact('product', 'categories','quantity', 'availableSizes', 'availableColors', 'brands'));
    }

    public function checkInventoryOrder(Request $request){
//        dd($request);
        $id = $request->id;
        $size = $request->size;
        $color = $request->color;

        $product = Product::where('id', $id)->with(['productEntries'])
            ->whereHas('productEntries', function ($query) use ($size, $color) {
                $query->where('size_id', $size)
                    ->where('color_id', $color);
            })
            ->first();

        if($product){
            $quantity = $product->productEntries[0]->quantity;
        }else{
            $quantity = 0;
        }
        return response()->json(['data'=>$quantity]);
    }

    public function cartItems(Request $request)
    {
        // Retrieve the authenticated user instance
        $user = Auth::user();

        // Retrieve the user ID
        $userId = $user->id;
        // Store the user ID in the session
        Session::put('userId', $userId);
        $ids = $request->ids;
        $products = [];
        Session::put('cartItems', $ids);

        foreach ($ids as $id) {
            $product = Product::where('id', $id)->with(['productEntries', 'images'])->first();

            if ($product) {
                $brand = Brands::where('id', $product->brands_id)->first();
                $brandName = $brand->brandName;
                $product->brandName = $brandName;

                $availableSizes = [];
                $availableColors = [];
                $quantity = 0;

                foreach ($product->productEntries as $productEntry) {
                    $size = Size::where('id', $productEntry->size_id)->first();
                    $color = Color::where('id', $productEntry->color_id)->first();

                    if ($size) {
                        $availableSizes[] = $size;
                    }

                    if ($color) {
                        $availableColors[] = $color;
                    }

                    $quantity += $productEntry['quantity'];
                }

                foreach ($product->images as $image) {
                    $product->images[] = $image;
                }

                $products[] = $product;
            }
        }

        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();
//dd($products);
        return response()->json(['data'=>view('items', compact('products', 'categories','quantity', 'availableSizes', 'availableColors', 'brands'))->render()]);
    }


}
