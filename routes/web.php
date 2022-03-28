<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
// use App\Mail\WelcomeMail;
use App\Models\Commodity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


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

// Route::name('shop.')->prefix('shop')->group(function(){
//     Route::get('/',[ShopController::class,'index'])->name('index');

//     Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

//     // 商品
//     Route::name('commodities.')->prefix('commodities')->group(function(){
//         Route::get('/create',[CommodityController::class,'create'])->name('create');
//         Route::post('/create',[CommodityController::class,'store'])->name('store');
//         Route::get('/{commodity}',[CommodityController::class,'show'])->name('show');
//         Route::get('/{commodity}/edit',[CommodityController::class,'edit'])->name('edit');
//         Route::put('/{commodity}',[CommodityController::class,'update'])->name('update');
//     });

//     Route::name('carts.')->prefix('carts')->group(function(){
//         Route::get('/',[CartController::class,'index'])->name('index');
//         Route::post('/',[CartController::class,'store'])->name('store');
//         Route::get('/test',[CartController::class,'test'])->name('test');
//     });
// });

Route::get('/articles',[ArticleController::class,'index'])->name('articles.index');
Route::get('/articles/create',[ArticleController::class,'create'])->name('articles.create');
Route::post('/articles',[ArticleController::class,'store'])->name('articles.store');
Route::get('/articles/{article}',[ArticleController::class,'show'])->name('articles.show');
Route::get('/articles/{article}/edit',[ArticleController::class,'edit'])->name('articles.edit');
Route::put('/articles/{article}',[ArticleController::class,'update'])->name('articles.update');
Route::delete('/articles/{article}',[ArticleController::class,'destroy'])->name('articles.destroy');
Route::put('/articles/{article}/reverse',[ArticleController::class,'reverse'])->name('articles.reverse');

Route::resource('/categories',CategoryController::class);

// Route::get('/emails', function(){
//     Mail::to('admin@gmail.com')->send(new WelcomeMail);
//     return new WelcomeMail ;
// } );

// Route::get('/google/auth', [SocialiteController::class,'redirectToProvider']);
// Route::get('/google/auth/callback', [SocialiteController::class,'handleProviderCallback']);

Route::get('/google/auth', function () {
    return Socialite::driver('google')->redirect();
})->name('google.auth');
 
Route::get('/google/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    dd($user);
 
    $user = User::firstOrCreate([
        'email' => $user->email
    ],[
        'name' => $user->name,
        'password' => '123',
        'email' => $user->email,
    ]);

    Auth::login($user,true);
    // $user->token

    return redirect( route('index'));
});