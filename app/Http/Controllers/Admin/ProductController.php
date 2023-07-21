<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductEntry;
use App\Models\Size;
use App\Models\Images;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
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
        return view('admin.dashboard', compact('products','categories', 'sizes', 'colors', 'brands'));
    }
    public function products()
    {
        $sizes = Size::all();
        $categories = ProductCategory::all();
        $colors = Color::all();
        $brands = Brands::all();
        return view('admin.products', compact('categories', 'sizes', 'colors', 'brands'));
    }
    public function productDatatable(){
//        $products = Product::all();
        $products = Product::with(['productEntries', 'images'])->get();
        foreach ($products as $product){
            $brand = Brands::where('id',$product['brands_id'])->first();
            $brandName = $brand['brandName'];
            $product['brandName'] = $brandName;
            foreach ($product->images as $image){
                $product['images'][] = $image;
            }
                foreach ($product->productEntries as $productEntry) {
//                $entry = $productEntry;
                    $size_id = $productEntry['size_id'];
                    $color_id = $productEntry['color_id'];
                    $size = (Size::where('id', $size_id)->first())['size_value'];
                    $color = (Color::where('id', $color_id)->first())['color_name'];
                }
        }


        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('brand', function ($product) {
                return $product['brandName'];
            })
            ->addColumn('image', function ($product) {


                $images = '<div class="slideshow-container" " aria-label="Beautiful Images">';
                foreach ($product['images'] as $index => $image) {
                    $imagePath = asset('storage/images/' . $image['image_name']);
                    $images .= '<div class="mySlides fade"><img class="imageSize" src="' . $imagePath . '" alt="Product Image"></div>';
                    break;
                }
                ;
                $images .= '</div>';
                return $images;
            })
            ->addColumn('images', function ($product) {
                $images = $product->images;
                $imagesDiv='';

                if ($images) {
                    foreach ($images as $image){
                        $imagesDiv.='
<div class="relative mb-2" id="' . $image->id . '">
<img src="' . Storage::url($image->image_path) . '"
class="h-20 max-w-xs"
alt="...">
<div class="absolute top-0 right-0">
<button type="button" class="deleteImage" data-image = "' . $image->id . '">
<svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
</button>
</div>
</div>';
                    }
                }
                return $imagesDiv;
            })
            ->addColumn('action', function ($product) {
                // Add the necessary HTML for the action column
                // For example, edit and delete buttons
                $actionBtn = '<div class="inline-flex">
                            <button type="button" id="' . $product->id . '" class="px-2 editProductBtn shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class=" w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                            </button>
                            <button type="button" id="' . $product->id . '" class="px-2 addInventoryBtn shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2"/>
  </svg>
  </button>
                            <button type="button" id="' . $product->id . '" class="deleteBtn shadow-lg inline-flex items-center text-white bg-red-600 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </button></div>';
                return $actionBtn;
            })
            ->rawColumns(['image','images','brand', 'action'])
            ->make(true);
    }




    public function productEntries(Request $request){
//        $products = Product::all();
        $id = $request->id;
        $entriesData = [];

            $product = Product::with(['productEntries', 'images'])->where('id', $id)->first();
                foreach ($product->productEntries as $productEntry) {
                    $size_id = $productEntry['size_id'];
                    $color_id = $productEntry['color_id'];
                    $size = (Size::where('id', $size_id)->first())['size_value'];
                    $color = (Color::where('id', $color_id)->first())['color_name'];
                    $quantity= $productEntry->quantity;
                    $entriesData[] = [
                        'id'=>$id,
                        'entry_id'=>$productEntry->id,
                        'size' => $size,
                        'size_id'=>$size_id,
                        'color' => $color,
                        'color_id'=>$color_id,
                        'quantity' => $quantity,
                    ];
                }



            return DataTables::of($entriesData)
                ->addIndexColumn()
                ->addColumn('size', function ($row) {
                    return $row['size'];
                })
                ->addColumn('color', function ($row) {
                    return $row['color'];
                })
                ->addColumn('quantity', function ($row) {
                    return $row['quantity'];
                })
                ->editColumn('size_id', function ($row) {
                    return $row['size_id'];
                })
                ->editColumn('color_id', function ($row) {
                    return $row['color_id'];
                })
                ->addColumn('action', function ($row) {
                    // Add the necessary HTML for the action column
                    // For example, edit and delete buttons
                    $actionBtn = '
                            <button type="button" id="' . $row['id'] . '" class="px-2 updateInventoryBtn shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2"/>
  </svg>
  </button>

                         ';
                    return $actionBtn;
                })
                ->rawColumns(['size', 'color', 'quantity','action'])
                ->make(true);
    }

    public function checkInventory(Request $request){
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
public function addInventory(Request $request){

    $formData = $request->data;

    // Step 2: Handle decoding and default values
    $processedData = [];

    foreach ($formData as $data){
        // URL-decode the value as it may be encoded

            $processedData[$data['name']] = $data['value'];

    }
//    dd($processedData);
    $id = $processedData['id'];
    $color = $processedData['color'];
    $size = $processedData['size'];
    $quantity = $processedData['quantity'];
    $discount = $processedData['discount'];


    $product = Product::where('id', $id)->with(['productEntries'])
        ->whereHas('productEntries', function ($query) use ($size, $color) {
            $query->where('size_id', $size)
                ->where('color_id', $color);
        })
        ->first();

    if($product){
        $product->productEntries[0]->update(['quantity'=>$quantity]);
    }else {

        $productEntry = new ProductEntry([
            'quantity' => $quantity,
            'color_id' => $color,
            'size_id' => $size,
            'discount' => $discount
        ]);

        $productEntry->save();
        $product = Product::where('id', $id)->get();

        $productEntry->product()->attach($id);
//        $product->productEntries()->attach($productEntry->id);
    }
    if ((!$product)) {
        return response()->json([
            'message' => 'Internal Server Error',
        ], 500);
    }
    return response()->json([
        'message' => 'Data added Succesfully',

    ]);
}


    public function updateInventory(Request $request){

        $data = $request->data;
//        dd($request -> quantity);
//        $id = $data['id'];
//        $size = $data['size_id'];
//        $color = $data['color_id'];
        $entry_id = $data['entry_id'];
        $quantity = (int)$request->quantity;

        $entry = ProductEntry::where('id', $entry_id)->first();




        if (!$entry) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
            // Access the first matching product entry

        }else {

            $entry -> update(['quantity'=>$quantity]);

            return response()->json([
                'message' => 'Inventory updated',
                'data' => $entry
            ]);
        }
    }

    public function createProduct(StoreProductRequest $request)
    {
        // Validate the form data
        $validatedData = [
            'productName' => $request->productName,
            'productCategory' => $request->productCategory,
            'brand' => $request->brand,
            'price' => $request->price,
//            'color' => $request->color,
//            'size' => $request->size,
//            'quantity' => $request->quantity,
            'images' => $request->file('images'),
//                'discount' => 'required',
//            'description' => $request->description,
        ];
//        dd($validatedData);
        // Create a new product entry
//        $productEntry = new ProductEntry([
//            'quantity' => $validatedData['quantity'],
//            'color_id' => $validatedData['color'],
//            'size_id' => $validatedData['size'],
//        ]);
//        $productEntry->save();

        // Create a new product
        $product = new Product([
            'product_name' => $validatedData['productName'],
            'product_desc' => $validatedData['description'],
            'price' => $validatedData['price'],
            'brands_id' => $validatedData['brand'],
            'category_id' => $validatedData['productCategory'],

        ]);

        $product->save();
//        $product->productEntries()->attach($productEntry->id);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $imageModel=new Images([
                   'image_name'=>$imageName
                ]);
                Storage::putFileAs('public/images', new File($image), $imageName);
                $imageModel->save();
                $product->images()->attach($imageModel->id);
            }
        }
        if ((!$product)) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data added Succesfully',

        ]);
    }

    public function showProductData(Request $request){
        $product = Product::where('id', $request->id)->with(['productEntries', 'images'])->first();
        if (!$product) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data retrieved Succesfully',
            'data' => $product
        ]);
    }

    public function updateProductData(StoreProductRequest $request)
    {
        $product  = Product::where('id', $request->id)->with(['productEntries', 'images'])->first();

        $validatedData = [
            'productName' => $request->productName,
            'productCategory' => $request->productCategory,
            'brand' => $request->brand,
            'price' => $request->price,
//            'color' => $request->color,
//            'size' => $request->size,
//            'quantity' => $request->quantity,
            'images' => $request->file('images'),
            'imageInput'=> $request->imageInput,
//                'discount' => 'required',
            'description' => $request->description,
        ];



//        dd($validatedData);
//        $product->productEntries()->update([
//            'quantity' => $validatedData['quantity'],
//            'color_id' => $validatedData['color'],
//            'size_id' => $validatedData['size'],
//        ]);

//        dd($product->productEntries);
        // Create a new product
        $updateProduct = Product::where('id', $request->id)->update([
            'product_name' => $validatedData['productName'],
            'product_desc' => $validatedData['description'],
            'price' => $validatedData['price'],
            'brands_id' => $validatedData['brand'],
            'category_id' => $validatedData['productCategory'],

        ]);
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $imageModel=new Images([
                    'image_name'=>$imageName
                ]);
                Storage::putFileAs('public/images', new File($image), $imageName);
                $imageModel->save();
                $product->images()->attach($imageModel->id);
            }
        }


        if ($updateProduct) {
            return response()->json([
                'message' => 'Product Updated Succesfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function deleteProduct(Request $request)
    {

        $product = Product::where('id', $request->id)->with(['productEntries', 'images'])->get()->first();

        // Delete the associated images
//        $images = $product->images;
//        foreach ($images as $image) {
//            // Delete the image file from storage (assuming you're using the default Laravel storage system)
//            Storage::delete('public/images/' . $image['image_name']);
//            // Delete the image record from the database
//            $image->delete();
//        }

        // Delete the associated product entries
        $productEntries = $product->productEntries;
        foreach ($productEntries as $productEntry) {
            $productEntry->delete();
        }

        // Delete the product itself
       $result = $product->productEntries()->detach();
//        $product->images()->detach();
//        $result=$product->delete();
        if ((!$result)) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data deleted Succesfully',
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = Images::where('id', $imageId)->first();
        $imageName = $image->image_name;
        $products= Product::with('images');


        if (Storage::disk('public')->exists($imageName)) {
            Storage::disk('public')->delete($imageName);
            $image->delete();
            $products->each(function ($product) use ($image) {
                $product->images()->detach($image->id);
            });
            return response()->json(['message' => 'Image deleted successfully']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }
}
