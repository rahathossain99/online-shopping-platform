<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\EnterpriseInfoController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// for non-existing route
Route::fallback(function (){
    return redirect()->back();
});

//front routes
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
Route::post('/mail-contact-us',[FrontController::class,'mailContact'])->name('front.mailContact');

Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.shop');
Route::get('/product/{productSlug}',[ShopController::class,'product'])->name('front.product');
Route::post('/save-rating/{productId}',[ShopController::class,'storeRating'])->name('front.storeRating');


Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/update-to-cart',[CartController::class,'updateToCart'])->name('front.updateToCart');
Route::post('/delete-cart',[CartController::class,'deleteCart'])->name('front.deleteCart');


Route::get('/checkout',[CheckoutController::class,'checkout'])->name('front.checkout');
Route::post('/checkout',[CheckoutController::class,'checkoutStore'])->name('front.checkoutStore');
Route::post('/get-shipping-charge',[CheckoutController::class,'getAmount'])->name('front.getShippingAmount');
Route::get('/thanks/{id?}',[CheckoutController::class,'thanks'])->name('front.thanks');
Route::get('/payment-cancel',[CheckoutController::class,'paymentCancel'])->name('front.paymentCancel');
Route::post('/webhook',[CheckoutController::class,'webhook'])->name('front.webhook');

Route::post('/apply-coupon',[CheckoutController::class,'applyCoupon'])->name('front.applyCoupon');
Route::post('/delete-coupon',[CheckoutController::class,'deleteCoupon'])->name('front.deleteCoupon');

Route::post('/add-to-wishlist',[WishlistController::class,'addToWishlist'])->name('front.addToWishlist');
Route::post('/delete-to-wishlist',[WishlistController::class,'deleteToWishlist'])->name('front.deleteToWishlist');

//user routes
Route::group(['prefix'=>'account'],function (){
    Route::group(['middleware'=>'guest'],function (){
        Route::get('/login',[AuthController::class,'login'])->name('user.login');
        Route::post('/login',[AuthController::class,'authenticate'])->name('user.authenticate');
        Route::get('/register',[AuthController::class,'register'])->name('user.register');
        Route::post('/register',[AuthController::class,'processAuth'])->name('user.processAuth');
        Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('user.forgotPassword');
        Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('user.processForgotPassword');
        Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('user.resetPassword');
        Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('user.processResetPassword');

    });
    Route::group(['middleware'=>'auth'],function (){
        Route::get('/profile',[AuthController::class,'profile'])->name('user.profile');
        Route::get('/logout',[AuthController::class,'logout'])->name('user.logout');
        Route::get('/change-password',[AuthController::class,'changePassword'])->name('user.changePassword');
        Route::post('/change-password-process',[AuthController::class,'changePasswordProcess'])->name('user.changePasswordProcess');

        Route::get('/my-orders',[AuthController::class,'myOrders'])->name('user.myOrders');
        Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('user.orderDetail');
        Route::get('/wishlist',[AuthController::class,'myWishlist'])->name('user.myWishlist');
        Route::post('/register/{userId}',[AuthController::class,'updateUser'])->name('user.updateUser');
        Route::post('/address',[AuthController::class,'updateAddress'])->name('user.updateAddress');


    });
});

//admin routes
Route::group(['prefix'=>'admin'],function (){
    Route::group(['middleware'=>'admin.guest'],function (){
        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware'=>'admin.auth'],function (){
        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');
        Route::get('/change-password',[SettingsController::class,'changePassword'])->name('admin.changePassword');
        Route::post('/change-password-process',[SettingsController::class,'changePasswordProcess'])->name('admin.changePasswordProcess');

        //category routes group
        Route::resources(['categories'=>CategoryController::class]);
        //subcategory routes group
        Route::resources(['sub-categories'=>SubCategoryController::class]);
        //brand routes group
        Route::resources(['brands'=>BrandController::class]);
        //product routes group
        Route::resources(['products'=>ProductController::class]);
        Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');
        //delete product image
        Route::delete('/products/images/{id}',[ProductImageController::class,'destroy'])->name('product-image.delete');
        //shipping routes
        Route::get('/shippings',[ShippingController::class,'index'])->name('shippings.index');
        Route::get('/shippings/create',[ShippingController::class,'create'])->name('shippings.create');
        Route::post('/shippings',[ShippingController::class,'store'])->name('shippings.store');
        Route::get('/shippings/{id}/edit',[ShippingController::class,'edit'])->name('shippings.edit');
        Route::post('/shippings/{id}',[ShippingController::class,'update'])->name('shippings.update');
        Route::delete('/shippings/{id}',[ShippingController::class,'destroy'])->name('shippings.destroy');
        //coupons routes
        Route::get('/coupons/create',[DiscountController::class,'create'])->name('coupons.create');
        Route::post('/coupons',[DiscountController::class,'store'])->name('coupons.store');
        Route::get('/coupons',[DiscountController::class,'index'])->name('coupons.index');
        Route::get('/coupons/{id}/edit',[DiscountController::class,'edit'])->name('coupons.edit');
        Route::put('/coupons/{id}',[DiscountController::class,'update'])->name('coupons.update');
        Route::delete('/coupons/{id}',[DiscountController::class,'destroy'])->name('coupons.destroy');
        //order routes
        Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
        Route::get('/orders/{orderId}',[OrderController::class,'detail'])->name('orders.detail');
        Route::post('/order/change-status/{orderId}',[OrderController::class,'changeOrderStatus'])->name('orders.changeOrderStatus');
        //user routes
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
        Route::put('/users/{id}',[UserController::class,'update'])->name('users.update');
        Route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.delete');
        //static page routes
        Route::get('/pages',[PageController::class,'index'])->name('pages.index');
        Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
        Route::post('/pages',[PageController::class,'store'])->name('pages.store');
        Route::get('/pages/{id}/edit',[PageController::class,'edit'])->name('pages.edit');
        Route::put('/pages/{id}',[PageController::class,'update'])->name('pages.update');
        Route::delete('/pages/{id}',[PageController::class,'destroy'])->name('pages.destroy');
        //enterprise routes
        Route::get('/enterprise/info',[EnterpriseInfoController::class,'set'])->name('enterprise.info');
        Route::post('/enterprise',[EnterpriseInfoController::class,'storeOrUpdate'])->name('enterprise.storeOrUpdate');

        //getting subcategory product route
        Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');
        // slug & image generator
        Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');
        Route::get('/getSlug',function (Request $request){
            $slug='';
            if(!empty($request->title)){
                $slug=Str::slug($request->title);
            }
            return response()->json([
                'status'=>true,
                'slug'=>$slug
            ]);
        })->name('getSlug');
    });
});
