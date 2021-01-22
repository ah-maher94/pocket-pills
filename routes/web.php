<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\uploadimageController;
use App\Http\Controllers\PocketPills\Staff;
use App\Http\Controllers\productinfoController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\User\UserCartController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
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

// Route::post('/uploadStaff/', [uploadimageController::class, 'uploadStaffImage']);
// Route::post('/uploadAdmin/', [uploadimageController::class, 'uploadAdminImage']);
// Route::post('/uploadUser/', [uploadimageController::class, 'uploadUserImage']);
// Route::post('/uploadProduct/', [uploadimageController::class, 'uploadProductImage']);
// Route::post('/uploadCategory/', [uploadimageController::class, 'uploadCategoryImage']);

Route::post('/getproduct/', [productinfoController::class, 'getProduct']);

Route::post('/appToCard/', [categoryController::class, 'addProduct']);

Route::post('/getQuantity/', [productinfoController::class, 'getQuantity']);



Route::resource('products',App\Http\Controllers\productinfoController::class);

Route::resource('category',App\Http\Controllers\categoryController::class);

Route::resource('suppliers',App\Http\Controllers\supplierController::class);

Route::resource('productsupplier',App\Http\Controllers\productsupplierController::class);


