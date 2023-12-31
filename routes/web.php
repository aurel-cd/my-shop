<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('logs', [LogViewerController::class, 'index']);
//Product routes before auth
Route::get('/', [ProductListController::class, 'dashboard']);
Route::post('/', [ProductListController::class, 'dashboard']);
Route::get('/getProductNames',[ProductListController::class,'getProductNames']);
Route::get('/product/{id}', [ProductListController::class, 'productInfo'])->name('productInfo');
Route::get('/checkInventoryOrder', [ProductListController::class, 'checkInventoryOrder'])->name('checkInventoryOrder');


//FILTERS
Route::get('/filteredProducts',[ProductListController::class,'filteredProducts']);
Route::post('/selectedProduct',[ProductListController::class,'selectedProduct']);
//CART ITEMS
Route::post('/cartItems',[ProductListController::class, 'cartItems'])->name('getItems');
Route::get('/cartItems',function(){
    return view('cartItems');
})->name('cartItems');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//SPECIFIED ROUTES AFTER AUTHENTICATION
Route::middleware(['auth'])->group(function(){
    Route::middleware(['role:admin'])->name('admin.')->prefix('admin')->group(function() {
        Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('home');
        Route::post('/users', [UserController::class, 'getForDatatable'])->name('users');
        Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
        Route::post('/showUserData', [UserController::class, 'showUserData'])->name('showUserData');
        Route::post('/updateUser', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/deleteUserById', [UserController::class, 'delete']);
    });
    Route::middleware(['role:admin|menager'])->name('admin.')->prefix('admin')->group(function() {
        Route::get('/products', [ProductController::class, 'products'])->name('products');
        Route::post('/products', [ProductController::class, 'productDatatable'])->name('productsDatable');
        Route::post('/productEntries', [ProductController::class, 'productEntries'])->name('productEntries');
        Route::post('/createProduct', [ProductController::class, 'createProduct'])->name('createProduct');
        Route::post('/showProductData', [ProductController::class, 'showProductData'])->name('showProductData');
        Route::post('/updateProductData', [ProductController::class, 'updateProductData'])->name('updateProductData');
        Route::get('/checkInventory', [ProductController::class, 'checkInventory'])->name('checkInventory');
        Route::post('/addInventory', [ProductController::class, 'addInventory'])->name('addInventory');
        Route::post('/updateInventory', [ProductController::class, 'updateInventory'])->name('updateInventory');
        Route::delete('deleteImage/{imageId}', [ProductController::class, 'deleteImage'])->name('deleteImage');
        Route::post('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('/orders', [OrderController::class, 'orderList'])->name('orders');
        Route::post('/orders', [OrderController::class, 'orderDatatable'])->name('orderDatatable');
        Route::post('/showOrderDetails', [OrderController::class, 'showOrderDetails'])->name('showOrderDetails');
        Route::get('/itemCharts',[ChartController::class, 'itemChart'])->name('itemCharts');
    });

    Route::middleware(['cors', 'role:user'])->name('user.')->prefix('user')->group(function() {
        Route::get('/userLandingpage', [ProductController::class, 'products'])->name('userLandingPage');
        Route::get('/dashboard', [ProductController::class, 'dashboard'])->middleware([ 'verified'])->name('dashboard');
        Route::post('/checkout',[StripeController::class, 'checkout'])->name('checkout');
        Route::post('/success',[StripeController::class, 'success'])->name('success');
        Route::get('/paymentDetails',[StripeController::class, 'getPaymentDetails'])->name('getPaymentDetails');
        Route::get('/orders',[OrderController::class, 'orders'])->name('orders');
        Route::post('/orders',[OrderController::class, 'orderDatatable'])->name('orderDatatable');
        Route::post('/showOrderDetails', [OrderController::class, 'showOrderDetails'])->name('showOrderDetails');
        Route::post('/cancelOrder', [StripeController::class, 'cancelOrder'])->name('cancelOrder');

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
