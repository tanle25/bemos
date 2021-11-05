<?php

use App\Http\Api\ViettelpostApi;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController\CartController;
use App\Http\Controllers\UserController\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController\ProductController;
use App\Http\Controllers\UserController\ProductReviewController;
use App\Http\Controllers\ViettelPostController;

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



Route::get('/', [HomeController::class,'index'])->name('home');


// RESOURCE



Route::resource('review', ProductReviewController::class);
Route::resource('detail',ProductController::class);
Route::resource('cart', CartController::class);
Route::resource('customer-order', OrderController::class)->middleware('auth');
Route::resource('comment', CommentController::class);
// END RESOURCE
Route::get('auth',[LoginController::class,'show'])->name('auth');
Route::post('auth/login',[LoginController::class,'login'])->name('auth.login');
Route::get('auth/logout',[LoginController::class,'logout'])->name('auth.logout');

Route::get('register',[RegisterController::class,'show'])->name('user.register');
Route::post('register',[RegisterController::class,'register'])->name('user.auth.register');


Route::get('district/{provice_id}',[HomeController::class,'getDistricts'])->name('getdistricts');
Route::get('ward/{district_id}',[HomeController::class,'getWards'])->name('getwards');
Route::get('street',[HomeController::class,'getStreet']);
// Route::get('{slug}',[HomeController::class,'showPost'])->name('post.showPost');

// CATEGORY
// Route::get('gioi-thieu',[HomeController::class,'showIntroduce'])->name('introduce');
Route::get('ajaxsearch',[SearchController::class,'ajaxSearch'])->name('ajax.search');

Route::get('search',[SearchController::class,'search'])->name('nomal.search');

Route::get('recenly',[HomeController::class,'getRecenly'])->name('product.recenly');

// Route::get('login',[LoginController::class,'show'])->name('user.login');
// Route::post('login',[LoginController::class,'login'])->name('user.post.login');
Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

Route::get('contact',[HomeController::class,'showContact'])->name('user.showcontact');
Route::post('contact',[HomeController::class,'contact'])->name('user.contact');

Route::get('remove/{item}',[CartController::class,'removeItem'])->name('cart.remove');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('post',[HomeController::class,'listPost'])->name('user.listPost');
Route::get('post/{slug}',[HomeController::class,'postDetail'])->name('user.postDetail');
// Route::get('payment-result',[OrderController::class,'paymentreturn']);
// Route::get('vnpay-ipnurl',[OrderController::class,'ipnUrl']);
Route::resource('pages', PageController::class)->only(['show']);
Route::get('category/{slug}',[HomeController::class,'category'])->name('categorymenu.show');
Route::get('shipping-fee', [ViettelPostController::class,'getFee'])->name('shippngFee');
Route::webhooks('webhook-receiving-url');


// Route::get('export-products',[HomeController::class,'productExport']);

//Shipping Caculator
Route::get('list-province',[HomeController::class,'listProvices']);
Route::get('list-distict/{id}',[HomeController::class,'listDistrictByProvince']);
Route::get('list-ward/{id}',[HomeController::class,'listWards']);



// VNPay test
Route::get('payment-result',[OrderController::class,'paymentreturn']);
Route::get('vnpay-ipnurl',[OrderController::class,'ipnUrl']);

// VNpay Product

// Route::get('payment-result',[OrderController::class,'paymentreturn']);
Route::get('vnpay-url',[OrderController::class,'Vnpay']);


