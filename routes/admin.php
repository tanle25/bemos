<?php
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyAndDemandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteConfig;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\ConfigContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ViettelPostController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;


Route::prefix('laravel-filemanager')->middleware('admin')->group(function(){
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => 'admin'], function () {

    // Route::get('send-to-viettel',[ViettelPostController::class,'login'])->name('create.viettel.order');
    Route::resource('menu', MenuController::class);
    Route::resource('/', AdminController::class);
    Route::resource('product', ProductController::class);
    Route::get('product/delete/{id}', [ProductController::class,'delete']);
    Route::resource('category', CategoryController::class);
    Route::resource('content', ConfigContentController::class);
    Route::resource('setting', WebsiteConfig::class);
    Route::resource('page', PageController::class);
    Route::get('slug',[PageController::class,'getSlug'])->name('page.slug');
    Route::resource('banner', BannerController::class);
    Route::resource('order', OrderController::class);
    Route::resource('contact', CustomerContactController::class);
    Route::resource('user-info', UserController::class);
    Route::resource('admin-permission', AdminController::class);
    Route::resource('rate', RatingController::class);
    Route::resource('post', PostController::class);
    Route::get('supply',[SupplyAndDemandController::class,'index'])->name('supply.index');
    Route::get('supply/update/{id}',[SupplyAndDemandController::class,'update'])->name('supply.update');
    Route::post('create-order',[ViettelPostController::class,'createViettelOrder'])->name('create.order');
    Route::get('export-all-product',[HomeController::class,'productExport']);

    Route::post('change-order-status',[ViettelPostController::class,'changeStatus'])->name('vt.change.status');

    Route::get('add-voucher',[VoucherController::class,'addVoucher']);

});

Route::get('login',[LoginController::class,'index'])->name('addmin.get.login');
Route::post('login',[LoginController::class,'login'])->name('admin.login');
