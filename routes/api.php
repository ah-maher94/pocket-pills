<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserInfoController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserInvoiceController;

use App\Http\Controllers\PocketPills\Staff;
use App\Http\Controllers\PocketPills\BranchProduct;
use App\Http\Controllers\PocketPills\Branch;
use App\Http\Controllers\PocketPills\Pharmacy;


use App\Http\Controllers\productinfoController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\productsupplierController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth
Route::post('/register', [RegisterController::class, 'store'])
->name('register');

Route::get('/login', [LoginController::class, 'login'])
->name('login');
Route::post('/login', [LoginController::class, 'loggedIn']);

Route::get('/logout', [LogoutController::class, 'logout'])
->name('logout');

// User Routes
Route::get('/users', [UserInfoController::class, 'getAllUsers'])
->name('allUsers');

Route::get('/users/{id}', [UserInfoController::class, 'getUser'])
->name('oneUser');
Route::delete('/users/{id}', [UserInfoController::class, 'deleteUser']);

Route::get('/users/{id}', [UserInfoController::class, 'getUser'])
->name('oneUserEdit');
Route::post('/users/{id}', [UserInfoController::class, 'updateUser']);

// Cart Routes
Route::get('/cart', [UserCartController::class, 'getCartProducts'])
->name('cartProducts');
Route::post('/cart', [UserInvoiceController::class, 'addInvoice']);

Route::delete('/cart/{productId}', [UserCartController::class, 'deleteProduct'])
->name('deleteCartProduct');

Route::post('/cart/{productId}', [UserCartController::class, 'addProduct'])
->name('addCartProduct');
Route::put('/cart/{productId}', [UserCartController::class, 'updateQuantity']);


// Customer Invoice Routes
Route::get('/customer/orders', [UserInvoiceController::class, 'getAllInvoices'])
->name('allOrders');
Route::get('/customer/orders/{invId}', [UserInvoiceController::class, 'getInvoice'])
->name('oneOrder');
Route::delete('/customer/orders/{invId}', [UserInvoiceController::class, 'deleteInvoice']);

// Pharmacy Invoice
Route::get('/pharmacy/{branchId}/orders', [UserInvoiceController::class, 'getAllInvoicesPharmacy'])
->name('allOrdersPharmacy');

Route::apiResource('staff', 'App\Http\Controllers\PocketPills\Staff');
Route::apiResource('branchproduct', 'App\Http\Controllers\PocketPills\BranchProduct');
Route::apiResource('branch', 'App\Http\Controllers\PocketPills\Branch');
Route::apiResource('pharmacy', 'App\Http\Controllers\PocketPills\Pharmacy');
Route::resource('products',App\Http\Controllers\productinfoController::class);

Route::resource('category',App\Http\Controllers\categoryController::class);

Route::resource('suppliers',App\Http\Controllers\supplierController::class);

Route::resource('productsupplier',App\Http\Controllers\productsupplierController::class);

