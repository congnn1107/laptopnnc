<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\DiscountPromotionController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PostController;
use App\Mail\Invoice;
use App\Model\Admin;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Role;
use App\Model\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
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

Route::resource("/categories", "CategoryController");

Route::prefix('/local')->name('local.')->group(function(){
    Route::get('/province',[LocalController::class,'getProvinces'])->name('province');
    Route::get('/district/parent={id}',[LocalController::class,'getDistricts'])->name('district');
    Route::get('/ward/parent={id}',[LocalController::class,'getWards'])->name('ward');
});
Route::get("/", 'HomeController@index')->name('shop.index');
Route::get("/san-pham", 'HomeController@storePage')->name('shop.product.index');
Route::get("/lien-he", 'HomeController@contactPage')->name('shop.contact');
Route::get('/san-pham/{slug}.html', 'HomeController@showProduct')->name('shop.product.show');
Route::get('/add-to-cart/{id}', 'ProductController@addToCart')->name('shop.product.addtocart');
Route::get('/checkout', 'HomeController@checkOut')->name('shop.checkout');
Route::post('/dat-hang', 'OrderController@storeForCustomer')->name('shop.order');
Route::post('/update-cart', 'ProductController@updateQuantityCartItem')->name('shop.product.update_qty_cart');
Route::get('/remove-cart-item/{id}', 'ProductController@removeCartItem')->name('shop.product.removecart');
Route::get('/livesearch','HomeController@liveSearch')->name('shop.livesearch');

Route::get('/clear-cart', function () {
    Cart::destroy();
    return back();
});
Route::get('/bai-viet','HomeController@postPage')->name('shop.post');
Route::get('/bai-viet/{slug}.html','HomeController@showPost')->name('shop.post.show');
Route::middleware(['shop.checkLogin'])->group(function(){
    Route::get('/test-login', function(){
        return "OK";
    });
    Route::get('/ca-nhan','HomeController@editUserInfo')->name('shop.user.edit');
    Route::put('/ca-nhan','HomeController@updateUserInfo')->name('shop.user.update');
});
Route::post('/login','HomeController@login')->name('shop.login')->middleware('shop.preventLogin');
Route::get('/logout','HomeController@logout')->name('shop.logout');
Route::post('/register','HomeController@register')->name('shop.register');
//khách: xem chương trình khuyến mại (test)
Route::get('discount/{slug}', function () {
    //làm gì đó
})->name('shop.discount.show');

//Trang Quản trị
Route::prefix("admin")->group(function () {
    Route::middleware(['admin.afterlogin'])->group(function () {
        Route::get("/login", [DashboardController::class, "login"])->name("admin.login");
        Route::post("/login", [DashboardController::class, "checkLogin"])->name("admin.check");
    });
   
    Route::get("/logout", [DashboardController::class, "logout"])->name("admin.logout");
    Route::middleware(['admin.login'])->group(function () {
        
        Route::get('/profile','DashboardController@profile')->name('dashboard.profile');
        Route::put('/profile','DashboardController@updateProfile')->name('dashboard.profile.update');

        Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("admin.dashboard");
        Route::get("/", [DashboardController::class, "dashboard"]);

        Route::get('/admins/json-list', 'AdminController@getDataList')->name('admins.getdatalist');
        Route::resource('admins', "AdminController");
        //quản lý ảnh sản phẩm
        Route::get('product/images', [ProductImageController::class, 'index'])->name('products.manage_image');
        Route::get('product/{id}/images', [ProductImageController::class, 'images'])->name('products.show_image');
        Route::post('product/{id}/images', [ProductImageController::class, 'store'])->name('products.store_image');
        Route::delete('product/{id}/images', [ProductImageController::class, 'destroy'])->name('products.delete_image');
        //quản lý khuyến mại, giảm giá
        Route::name('promotion.')->group(function () {
            Route::prefix('promotion')->group(function () {
                Route::get('/', [DiscountPromotionController::class, 'index'])->name('index');
                //d: discount - giảm giá

                Route::get('/create', [DiscountPromotionController::class, 'createDiscount'])->name('create');
                Route::post('/store', [DiscountPromotionController::class, 'storeDiscount'])->name('store');
                Route::get('/{id}/edit', [DiscountPromotionController::class, 'editDiscount'])->name('edit');
                Route::put('/{id}/update', [DiscountPromotionController::class, 'updateDiscount'])->name('update');
                Route::post('/{id}/update', [DiscountPromotionController::class, 'addProductsToDiscount'])->name('products');
                Route::put('/', [DiscountPromotionController::class, 'destroyDiscount'])->name('destroy');
            });
        });
        Route::resource('/product', 'ProductController');
        Route::resource('/cpu', "CPUController");
        Route::resource('/gpu', "GPUController");
        Route::resource('/customer', 'CustomerController');
        // Bảo hành
        Route::resource('/warranty', 'WarrantyController');
        Route::resource('/warranty/log', 'WarrantyLogController');

        //slider
        Route::resource('/slider', 'SliderController');
        Route::post('slider/stt', 'SliderController@changeStatus')->name('slider.stt');
        //banner
        Route::resource('/banner', 'BannerController');
        Route::post('banner/stt', 'BannerController@changeStatus')->name('banner.stt');
        //order
        Route::post('/change-status','OrderController@changeStatus')->name('order.changeStatus');

        Route::resource('/order', 'OrderController');
        Route::post('/order/search-product', 'OrderController@searchProduct')->name('order.search_product');
        Route::resource('/post','PostController');
        Route::resource('/user','UserController');
    });
});


