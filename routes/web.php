<?php

use App\Http\Controllers\ApiStatusController;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\api_auth;
use App\Models\ApiStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('api.')->prefix('api')->group(function(){

    Route::get('/',function(){ return redirect()->route('api.dashboard.index'); });
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    // Route::get('/',function(){ return view('api.dashboard.index'); })->middleware(api_auth::class);

    Route::get('isholiday',function(){ return response()->json(['status' => 'success',
                                                                'code' => '200',
                                                                'message' => '123'],200); })->middleware(api_auth::class);
    Route::get('/apitoken', [ApiTokenController::class,'index'])->name('apitoken.index');
    Route::post('/apitoken',[ApiTokenController::class,'generate'])->name('apitoken.generate');

    Route::patch('/apistatus/{name}',[ApiStatusController::class,'changeStatus'])->name('apistatus.changestatus');
    // Route::patch('/apistatus/{name}',function(){ return 1; });
});

