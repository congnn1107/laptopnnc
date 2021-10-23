<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\DiscountPromotionController;
use App\Model\Admin;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Role;
use App\Model\Slider;
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
//quản lý khuyến mại, giảm giá
Route::name('promotion.')->group(function(){
    Route::prefix('promotion')->group(function(){
        Route::get('/',[DiscountPromotionController::class,'index'])->name('index');
        //d: discount - giảm giá
        Route::name('d.')->group(function(){
            Route::prefix('/d')->group(function(){
                Route::get('/create',[DiscountPromotionController::class,'createDiscount'])->name('create');
                Route::post('/store',[DiscountPromotionController::class,'storeDiscount'])->name('store');
                Route::get('/{id}/edit',[DiscountPromotionController::class,'editDiscount'])->name('edit');
                Route::put('/{id}/update',[DiscountPromotionController::class,'updateDiscount'])->name('update');
                Route::post('/{id}/update',[DiscountPromotionController::class,'addProductsToDiscount'])->name('products');
                Route::put('/',[DiscountPromotionController::class,'destroyDiscount'])->name('destroy');
            });
        });
        //p: promotion - khuyến mại
        Route::name('p.')->group(function(){
            Route::prefix('/p')->group(function(){
                Route::get('/create',[DiscountPromotionController::class,'createPromotion'])->name('create');
                Route::post('/store',[DiscountPromotionController::class,'storePromotion'])->name('store');
                Route::get('/{id}/edit',[DiscountPromotionController::class,'editPromotion'])->name('edit');
                Route::put('/{id}/update',[DiscountPromotionController::class,'updatePromotion'])->name('update');
                Route::post('/{id}/update',[DiscountPromotionController::class,'addProductsToPromotion'])->name('products');
                Route::put('/',[DiscountPromotionController::class,'destroyPromotion'])->name('destroy');
            });
        });
        
    });
});
//khách: xem chương trình khuyến mại (test)
Route::get('discount/{slug}',function(){
    //làm gì đó
})->name('discount.show');
Route::get('promotion/{slug}',function(){
    //làm gì đó
})->name('promotion.show');

//xem slider
Route::get('test/slider', function(){
    $slider = Slider::where('status',1)->get();
    return view("slidertest",compact('slider'));
});
//end test
Route::resource('/product','ProductController');
Route::resource('/cpu',"CPUController");
Route::resource('/gpu',"GPUController");
Route::resource('/customer','CustomerController');
// Bảo hành
Route::resource('/warranty','WarrantyController');
Route::resource('/warranty/log','WarrantyLogController');

//slider
Route::resource('/slider','SliderController');
Route::post('slider/stt','SliderController@changeStatus')->name('slider.stt');

