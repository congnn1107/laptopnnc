<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockController;
use App\Model\Admin;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Role;
use Illuminate\Support\Facades\Route;

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

Route::resource("/categories","CategoryController");
//test
Route::get("/test",function(){
    $admins = Admin::onlyTrashed()->first();
    $role = $admins->role()->get();
    return [$admins,$role];
});
Route::get('/test-dashboard',function(){
    return view('admin.dashboard');
});
Route::get('/test-master',function(){
    return view('admin.layout.master');
});
Route::get('/', function () {
    return view('welcome');
});
//end test

Route::prefix("admin")->group(function(){
    
    Route::middleware(['admin.login'])->group(function(){
        Route::get("/dashboard",[DashboardController::class,"dashboard"])->name("admin.dashboard");
        Route::get("/",[DashboardController::class,"dashboard"]);
        Route::get("/login",[DashboardController::class,"login"])->name("admin.login");
        Route::post("/login",[DashboardController::class,"checkLogin"])->name("admin.check");
    });
    Route::get("/logout", [DashboardController::class,"logout"])->name("admin.logout");
});
Route::get('/admins/json-list','AdminController@getDataList')->name('admins.getdatalist');
Route::resource('admins',"AdminController");
//quản lý ảnh sản phẩm
Route::get('product/images',[ProductImageController::class,'index'])->name('products.manage_image');
Route::get('product/{id}/images',[ProductImageController::class,'images'])->name('products.show_image');
Route::post('product/{id}/images',[ProductImageController::class,'store'])->name('products.store_image');
Route::delete('product/{id}/images',[ProductImageController::class,'destroy'])->name('products.delete_image');
//quản lý giá
Route::get('product/stocks',[ProductStockController::class,'index'])->name('products.manage_stock');
Route::get('products/{id}/stocks',[ProductStockController::class,'manage'])->name('products.show_stock');
Route::post('products/{id}/stocks',[ProductStockController::class,'store'])->name('products.store_stock');
Route::put('products/{id}/stocks',[ProductStockController::class,'update'])->name('products.update_stock');
Route::resource('/product','ProductController');
Route::resource('/cpu',"CPUController");
Route::resource('/gpu',"GPUController");

