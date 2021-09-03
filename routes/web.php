<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
Route::resource('/product','ProductController');