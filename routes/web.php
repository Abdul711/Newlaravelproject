<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryController;
use App\Http\Controllers\Admin\Color\ColorController;
use App\Http\Controllers\Admin\Size\SizeController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Tax\TaxController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SettingWebsiteController;
/*
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
Route::get('/', [FrontController::class,'index']);
Route::get('/product/{id}', [FrontController::class,'view_product']);
Route::get('/category/{id}', [FrontController::class,'view_product_by_cat']);
Route::get('/sub_category/{id}', [FrontController::class,'view_product_by_sub']);
Route::get('/pastOrder',[FrontController::class,'pastOrder']);
Route::get('/remdemPoint',[FrontController::class,'rad']);
Route::get('/cancel/{id}',[FrontController::class,'cancel_order']);
Route::get('/redeem/{id}',[FrontController::class,'redeem']);
Route::get('/remove_coupon',[FrontController::class,'remove_coupon']);
Route::get('/readd/{id}',[FrontController::class,"readd"]);
    Route::get('/send_invite', [FrontController::class,'invite_user']);
Route::get('/customer_verify/{token?}',[FrontController::class,'customer_verify']);

Route::get('/logout', function () {

    session()->forget('FRONT_USER_LOGIN','0');   
    session()->forget('FRONT_USER_ID','0');   
    session()->forget('FRONT_USER_NAME','');
   return redirect('/');
});
Route::get('/my_account', function () {
    return view('front_end.account');
});
Route::get('/register_success', function () {
    return view('front_end.register_success');
});
Route::post('/review_rating',[FrontController::class,'review_rating']);

Route::get('/forget_password', function () {
    return view('front_end.forget_password');
});
Route::get('/my_contact', function () {
    return view('front_end.contact');
});

Route::get('/search_item/{id}',[FrontController::class,"search"]);
Route::get('/print_invoice/{id}',[FrontController::class,"invoice"]);
Route::get('/thank',[FrontController::class,"thanks"]);
Route::get('/view_detail/{id}',[FrontController::class,"view_datail"]);
Route::get('/cart_total',[FrontController::class,"cart_total"]);
Route::get('/success', function () {
    return view('front_end.verify_success');
});
Route::get('/failure', function () {
    return view('front_end.verify_failure');
});

Route::get('/cart',[FrontController::class,'cart_view']);
Route::get('/place_coupon/{c}',[FrontController::class,'apply_coupon']);
Route::get('/checkout',[FrontController::class,'checkout']);
Route::post('add_cart',[FrontController::class,"add_to_cart"]);  

Route::get('/reset_password/{id?}',[FrontController::class,'reset_p']);

Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontController::class,'login_process'])->name('registration.login_process');
Route::post('forget_password',[FrontController::class,'forget_password'])->name('registration.forget_password');
Route::get('/cart_detail',[FrontController::class,'cart_detail']);
Route::post('/place_order',[FrontController::class,'PlaceOrder'])->name('placeorder.store');
Route::post('/passwordreset',[FrontController::class,'reset_new_password'])->name('reset_password.store');
Route::get('admin/add_admin',[AdminController::class,'add_admin']);
Route::get('admin',[AdminController::class,'index']);
Route::get('admin/update/{id?}',[AdminController::class,'update_admin']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');
Route::group(['middleware'=>'admin_auth'],function(){
Route::get('admin/order/status/{id}/{status}',[AdminController::class,'update_order_status']);
Route::get('admin/order_cancel/{id}',[AdminController::class,'order_cancel']);
    Route::get('admin/order',[AdminController::class,"orders_detail"]);

    Route::get('admin/email_detail/{id}',[AdminController::class,"email_detail"]);
    Route::get('admin/view_detail/{id}',[AdminController::class,"orders_view_detail"]);
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);
    Route::get('admin/manage',[AdminController::class,'manage_account']);
    Route::post('admin/manage_admin_process',[AdminController::class,'manage_admin_process'])->name('admin.manage_admin_process'); 
    /* Crud Operation Route For Category */
    Route::get('admin/category',[CategoryController::class,'show']);
    Route::get('admin/category/delete/{id}',[CategoryController::class,'destroy']);
     Route::get('/reset/{?token}',[FrontController::class,'reset_p']);
    Route::get('admin/category/manage_category/{id?}',[CategoryController::class,'manage']);
    Route::post('admin/category/manage_category',[CategoryController::class,'manage_category_process'])->name('category.store');
    Route::get('admin/category/status/{id}/{status}',[CategoryController::class,'update_status']);
/* Crud Operation Route For Sub Category */

    Route::get('admin/sub_category',[SubCategoryController::class,'show']);
    Route::get('admin/sub_category/delete/{id}',[SubCategoryController::class,'destroy']);
    Route::get('admin/sub_category/status/{id}/{status}',[SubCategoryController::class,'update_status']);
    Route::get('admin/sub_category/manage_sub_category/{id?}',[SubCategoryController::class,'manage']);
    Route::post('admin/sub_category/manage_sub_category',[SubCategoryController::class,'manage_sub_category_process'])->name('sub_category.store');
      /* Crud Operation Route For Product */
      Route::get('admin/product',[ProductController::class,'show']);

      Route::get('admin/product/manage_product/{id?}',[ProductController::class,'manage_product']);
      Route::post('admin/product/manage_producty_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
      Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
      Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
      Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
      Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);


     Route::get('admin/coupon',[CouponController::class,'show']);
Route::get('admin/coupon/delete/{id}',[CouponController::class,'destroy']);
Route::get('admin/coupon/status/{id}/{status}',[CouponController::class,'update_status']);

Route::get('admin/coupon/manage_coupon/{id?}',[CouponController::class,'manage']);

Route::get('admin/coupon/view_detail/{id?}',[CouponController::class,'view_coupon_detail']);
Route::post('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon_process'])->name('coupon.store');

/* Crud Operation Route For Color */
Route::get('admin/color',[ColorController::class,'show']);
Route::get('admin/color/delete/{id}',[ColorController::class,'destroy']);

Route::get('admin/color/manage_color/{id?}',[ColorController::class,'manage']);
Route::post('admin/color/manage_color',[ColorController::class,'manage_color_process'])->name('color.store');
Route::get('admin/color/status/{id}/{status}',[ColorController::class,'update_status']);
Route::get('admin/customers',[AdminController::class,'customers']);
Route::get('admin/customers/customer_pdf',[FrontController::class,'customer_laravel_pdf']);
Route::get('admin/customers/customer_excel',[AdminController::class,'customer_laravel_excel']);
Route::get('admin/inventory/inventory_excel',[AdminController::class,'inventory_laravel_excel']);
Route::get('admin/inventory/inventory_pdf',[AdminController::class,'inventory_laravel_pdf']);
Route::get('admin/inventory',[AdminController::class,'inventory']);
/* Crud Operation Route For Size */
Route::get('admin/size',[SizeController::class,'show']);
Route::get('admin/size/delete/{id}',[SizeController::class,'destroy']);

Route::get('admin/size/manage_size/{id?}',[SizeController::class,'manage']);
Route::post('admin/size/manage_size',[SizeController::class,'manage_size_process'])->name('size.store');
Route::get('admin/size/status/{id}/{status}',[SizeController::class,'update_status']);
/* Crud Operation Route For Brand */
Route::get('admin/brand',[BrandController::class,'show']);
Route::get("admin/sub/{id}",[ProductController::class,"cat_by_id"]);
Route::get('admin/brand/manage_brand/{id?}',[BrandController::class,'create']);
Route::post('admin/brand/manage_brand',[BrandController::class,'store'])->name('brand.store');
Route::get('admin/brand/delete/{id}',[BrandController::class,'destroy']);
Route::get('admin/brand/status/{id}/{status}',[BrandController::class,'update_status']);
/* Crud Operation Route For Tax */
Route::get('admin/tax',[TaxController::class,'index']);
Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
Route::get('admin/tax/manage_tax/{id?}',[TaxController::class,'manage_tax']);
Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process');
Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);
/* Crud Operation Route For Banner */

Route::get('admin/banner',[BannerController::class,'index']);
Route::get('admin/banner/manage_banner/{id?}',[BannerController::class,'manage']);
Route::post('admin/banner/manage_banner_process',[BannerController::class,'store'])->name('banner.store');
Route::get('admin/banner/status/{status?}/{id?}',[BannerController::class,'update']);
Route::get('admin/banner/delete/{id}',[BannerController::class,'delete']);
/* Crud Operation Route For Vendor */
Route::get('admin/vendor',[VendorController::class,'index']);
Route::get('admin/vendor/manage_vendor',[VendorController::class,'manage_vendor']);
Route::get('admin/vendor/manage_vendor/{id}',[VendorController::class,'manage_vendor']);
Route::post('admin/vendor/manage_vendor_process',[VendorController::class,'manage_vendor_process'])->name('vendor.manage_vendor_process');
Route::get('admin/vendor/delete/{id}',[VendorController::class,'delete']);
Route::get('admin/vendor/status/{status}/{id}',[VendorController::class,'status']);
Route::get('admin/setting',[SettingWebsiteController::class,"index"]);  
Route::post('admin/setting',[SettingWebsiteController::class,'manage_web_process'])->name('settingweb.manage_website_process');
Route::post('admin/reward/manage_rewards',[AdminController::class,'manage_reward_process'])->name('reward.store');   
Route::get('admin/reward/manage_rewards',[AdminController::class,'manage_reward']);     
Route::get('admin/reward',[AdminController::class,"reward_detail"]);
Route::get('admin/reward/status/{id}',[AdminController::class,"reward_status"]);


Route::get('/admin/logout', function () {
        if(session()->has('ADMIN_LOGIN')){
             session()->forget('ADMIN_LOGIN');
             session()->flash("session_logout","Logout Successfully");
            return  redirect('admin');
        }else{
            return redirect('admin');
        }
    
    });
});





