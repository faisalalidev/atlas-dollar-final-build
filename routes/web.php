<?php

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

const WEB_HOME_CONTROLLER = \App\Http\Controllers\Web\HomeController::class;
const WEB_Inventories_CONTROLLER = \App\Http\Controllers\Web\InventoryController::class;
const WEB_AUTH_CONTROLLER = \App\Http\Controllers\Web\AuthController::class;
const WEB_CART_CONTROLLER = \App\Http\Controllers\Web\CartController::class;
const WEB_ORDER_CONTROLLER = \App\Http\Controllers\Web\OrderController::class;
const WEB_CMS_CONTROLLER = \App\Http\Controllers\Web\CMSController::class;

Route::get('/', [WEB_HOME_CONTROLLER, 'index'])->name(config('constants.WEB_PREFIX') . 'home');
Route::get('/shop', [WEB_Inventories_CONTROLLER, 'index'])->name(config('constants.WEB_PREFIX') . 'shop');
Route::get('/products', [WEB_Inventories_CONTROLLER, 'products'])->name(config('constants.WEB_PREFIX') . 'products');
Route::get('cms/{slug}', [WEB_CMS_CONTROLLER, 'view'])->name(config('constants.WEB_PREFIX') . 'cms_view');


Route::middleware('guest:' . config('constants.WEB_GUARD_NAME'))->group(function () {

    Route::get('/login', [WEB_AUTH_CONTROLLER, 'login'])->name(config('constants.WEB_PREFIX') . 'login');
    Route::get('/forgot-password', [WEB_AUTH_CONTROLLER, 'forgotPassword'])->name(config('constants.WEB_PREFIX') . 'forgot_password');
    Route::post('forgot-password-reset', [WEB_AUTH_CONTROLLER, 'forgotPasswordRequest'])->name(config('constants.WEB_PREFIX') . 'forgot_password_request');
    Route::get('verify-email/{token}', [WEB_AUTH_CONTROLLER, 'verifyEmail'])->name(config('constants.WEB_PREFIX') . 'forgot_password_verify_email');
    Route::post('forgot-password-change', [WEB_AUTH_CONTROLLER, 'forgotPasswordChangeRequest'])->name(config('constants.WEB_PREFIX') . 'forgot_password_change');
    Route::post('authenticate', [WEB_AUTH_CONTROLLER, 'authenticate'])->name(config('constants.WEB_PREFIX') . 'authentication');
    Route::post('signup', [WEB_AUTH_CONTROLLER, 'signup'])->name(config('constants.WEB_PREFIX') . 'signup');
});

Route::middleware(['auth:' . config('constants.WEB_GUARD_NAME')])->group(function () {

    Route::get('/account', [WEB_AUTH_CONTROLLER, 'account'])->name(config('constants.WEB_PREFIX') . 'account');

    Route::get('logout', [WEB_AUTH_CONTROLLER, 'logout'])->name(config('constants.WEB_PREFIX') . 'logout');

    Route::post('edit-profile', [WEB_AUTH_CONTROLLER, 'updateProfileRequest'])->name(config('constants.WEB_PREFIX') . 'update_profile');

    Route::post('recently-viewed/{inventory_id}', [WEB_Inventories_CONTROLLER, 'addToRecentlyViewed'])->name(config('constants.WEB_PREFIX') . 'recently_viewed');

    Route::get('cart', [WEB_CART_CONTROLLER, 'index'])->name(config('constants.WEB_PREFIX') . 'cart');

    Route::get('view-saved-cart/{id}', [WEB_CART_CONTROLLER, 'viewSavedCart'])->name(config('constants.WEB_PREFIX') . 'view_saved_cart');

    Route::get('remove-saved-cart/{id}', [WEB_CART_CONTROLLER, 'removeSavedCart'])->name(config('constants.WEB_PREFIX') . 'remove_saved_cart');

    Route::get('load-saved-cart/{id}', [WEB_CART_CONTROLLER, 'loadSavedCart'])->name(config('constants.WEB_PREFIX') . 'load_saved_cart');

    Route::post('save-cart' , [WEB_CART_CONTROLLER, 'saveCart'])->name(config('constants.WEB_PREFIX') . 'save_cart');

    Route::get('clear-cart', [WEB_CART_CONTROLLER, 'clearCart'])->name(config('constants.WEB_PREFIX') . 'clear_cart');

    Route::get('checkout', [WEB_CART_CONTROLLER, 'checkout'])->name(config('constants.WEB_PREFIX') . 'checkout');

    Route::post('order', [WEB_ORDER_CONTROLLER, 'placeOrder'])->name(config('constants.WEB_PREFIX') . 'order');

    Route::get('view-order/{id}', [WEB_ORDER_CONTROLLER, 'view'])->name(config('constants.WEB_PREFIX') . 'order_view');

    Route::get('bulk-order', [WEB_ORDER_CONTROLLER, 'bulkOrder'])->name(config('constants.WEB_PREFIX') . 'bulk_order');

    Route::get('quick-order', [WEB_ORDER_CONTROLLER, 'quickOrder'])->name(config('constants.WEB_PREFIX') . 'quick_order');

});
