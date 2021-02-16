<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TaxController;
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
    return view('front_end.index');
});
Route::get('admin',[AdminController::class,'index']);

Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);
/* Crud Operation Route For Category */
    Route::get('admin/category',[CategoryController::class,'show']);
    Route::get('admin/category/delete/{id}',[CategoryController::class,'destroy']);
    Route::get('admin/category/manage_category',[CategoryController::class,'manage']);
    Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage']);
    Route::post('admin/category/manage_category',[CategoryController::class,'manage_category_process'])->name('category.store');
    Route::get('admin/category/status/{id}/{status}',[CategoryController::class,'update_status']);
/* Crud Operation Route For Sub Category */

    Route::get('admin/sub_category',[SubCategoryController::class,'show']);
    Route::get('admin/sub_category/delete/{id}',[SubCategoryController::class,'destroy']);
    Route::get('admin/sub_category/manage_sub_category',[SubCategoryController::class,'manage']);
    Route::get('admin/sub_category/status/{id}/{status}',[SubCategoryController::class,'update_status']);
    Route::get('admin/sub_category/manage_sub_category/{id}',[SubCategoryController::class,'manage']);
    Route::post('admin/sub_category/manage_sub_category',[SubCategoryController::class,'manage_sub_category_process'])->name('sub_category.store');
      /* Crud Operation Route For Product */
      Route::get('admin/product',[ProductController::class,'show']);
      Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
      Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
      Route::post('admin/product/manage_producty_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
      Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
      Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
      Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
      Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);


Route::get('admin/coupon',[CouponController::class,'show']);
Route::get('admin/coupon/delete/{id}',[CouponController::class,'destroy']);
Route::get('admin/coupon/status/{id}/{status}',[CouponController::class,'update_status']);
Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage']);
Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class,'manage']);
Route::post('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon_process'])->name('coupon.store');

/* Crud Operation Route For Color */
Route::get('admin/color',[ColorController::class,'show']);
Route::get('admin/color/delete/{id}',[ColorController::class,'destroy']);
Route::get('admin/color/manage_color',[ColorController::class,'manage']);
Route::get('admin/color/manage_color/{id}',[ColorController::class,'manage']);
Route::post('admin/color/manage_color',[ColorController::class,'manage_color_process'])->name('color.store');
Route::get('admin/color/status/{id}/{status}',[ColorController::class,'update_status']);
/* Crud Operation Route For Size */
Route::get('admin/size',[SizeController::class,'show']);
Route::get('admin/size/delete/{id}',[SizeController::class,'destroy']);
Route::get('admin/size/manage_size',[SizeController::class,'manage']);
Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage']);
Route::post('admin/size/manage_size',[SizeController::class,'manage_size_process'])->name('size.store');
Route::get('admin/size/status/{id}/{status}',[SizeController::class,'update_status']);
/* Crud Operation Route For Brand */
Route::get('admin/brand',[BrandController::class,'show']);
Route::get('admin/brand/manage_brand',[BrandController::class,'create']);
Route::get('admin/brand/manage_brand/{id}',[BrandController::class,'create']);
Route::post('admin/brand/manage_brand',[BrandController::class,'store'])->name('brand.store');
Route::get('admin/brand/delete/{id}',[BrandController::class,'destroy']);
Route::get('admin/brand/status/{id}/{status}',[BrandController::class,'update_status']);
Route::get('admin/tax',[TaxController::class,'index']);

Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
Route::get('admin/tax/manage_tax/{id}',[TaxController::class,'manage_tax']);
Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process');
Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);

    Route::get('/admin/logout', function () {
        if(session()->has('ADMIN_LOGIN')){
             session()->forget('ADMIN_LOGIN');
            return  redirect('admin');
        }else{
            return redirect('admin');
        }
    
    });
});





