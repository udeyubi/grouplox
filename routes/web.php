<?php

use App\Http\Controllers\CommodityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Models\Commodity;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::name('shop.')->prefix('shop')->group(function(){
    Route::get('/',[ShopController::class,'index'])->name('index');

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    // 商品
    Route::name('commodities.')->prefix('commodities')->group(function(){
        Route::get('/create',[CommodityController::class,'create'])->name('create');
        Route::post('/create',[CommodityController::class,'store'])->name('store');
        Route::get('/{commodity}',[CommodityController::class,'show'])->name('show');
        Route::get('/{commodity}/edit',[CommodityController::class,'edit'])->name('edit');
        Route::put('/{commodity}',[CommodityController::class,'update'])->name('update');
    });
});


