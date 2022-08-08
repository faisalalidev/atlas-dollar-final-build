<?php

use Illuminate\Support\Facades\Route;

const ADMIN_APPLICATION_SETTING_CONTROLLER = \App\Http\Controllers\Admin\ApplicationController::class;
const ADMIN_INVENTORY_CONTROLLER = \App\Http\Controllers\Admin\InventoryController::class;
const ADMIN_PORTAL_USER_CONTROLLER = \App\Http\Controllers\Admin\PortalUserController::class;
const ADMIN_DASHBOARD_CONTROLLER = \App\Http\Controllers\Admin\DashboardController::class;
const ADMIN_ROLE_CONTROLLER = \App\Http\Controllers\Admin\RoleController::class;
const ADMIN_AUTH_CONTROLLER = \App\Http\Controllers\Admin\AuthController::class;
const ADMIN_CATEGORY_CONTROLLER = \App\Http\Controllers\Admin\CategoryController::class;
const ADMIN_STORE_CONTROLLER = \App\Http\Controllers\Admin\StoreController::class;
const ADMIN_CRON_JOB_CONTROLLER = \App\Http\Controllers\Admin\CustomCronJobController::class;
const ADMIN_INVOICE_CONTROLLER = \App\Http\Controllers\Admin\InvoiceController::class;
const ADMIN_BANNER_CONTROLLER = \App\Http\Controllers\Admin\BannerController::class;
const ADMIN_MANAGER_CONTROLLER = \App\Http\Controllers\Admin\StoreManagerController::class;
const ADMIN_ORDER_CONTROLLER = \App\Http\Controllers\Admin\OrderController::class;
const ADMIN_EMAIL_CONTROLLER = \App\Http\Controllers\Admin\EmailController::class;
const ADMIN_CMS_CONTROLLER = \App\Http\Controllers\Admin\CMSController::class;
const ADMIN_SETTINGS_CONTROLLER = \App\Http\Controllers\Admin\SettingsController::class;

Route::middleware('guest:' . config('constants.ADMIN_GUARD_NAME'))->group(function () {

    Route::get('/', [ADMIN_AUTH_CONTROLLER, 'login'])->name(config('constants.ADMIN_PREFIX') . 'login');
    Route::post('authenticate', [ADMIN_AUTH_CONTROLLER, 'authenticate'])->name(config('constants.ADMIN_PREFIX') . 'authentication');
    Route::get('forgot-password', [ADMIN_AUTH_CONTROLLER, 'forgotPassword'])->name(config('constants.ADMIN_PREFIX') . 'forgot_password');
    Route::post('forgot-password-reset', [ADMIN_AUTH_CONTROLLER, 'forgotPasswordRequest'])->name(config('constants.ADMIN_PREFIX') . 'forgot_password_request');
    Route::get('verify-email/{token}', [ADMIN_AUTH_CONTROLLER, 'verifyEmail'])->name(config('constants.ADMIN_PREFIX') . 'forgot_password_verify_email');
    Route::post('forgot-password-change', [ADMIN_AUTH_CONTROLLER, 'forgotPasswordChangeRequest'])->name(config('constants.ADMIN_PREFIX') . 'forgot_password_change');

});

Route::get('invoices-pdf/{id}', [ADMIN_INVOICE_CONTROLLER, 'downloadPDF'])->name(config('constants.ADMIN_PREFIX') . 'invoices_pdf');

Route::middleware('auth:' . config('constants.ADMIN_GUARD_NAME'))->group(function () {

    //Auth Routes
    Route::get('logout', [ADMIN_AUTH_CONTROLLER, 'logout'])->name(config('constants.ADMIN_PREFIX') . 'logout');
    Route::get('dashboard', [ADMIN_DASHBOARD_CONTROLLER, 'index'])->name(config('constants.ADMIN_PREFIX') . 'dashboard');
    Route::get('update-profile', [ADMIN_AUTH_CONTROLLER, 'updateProfile'])->name(config('constants.ADMIN_PREFIX') . 'update_profile');
    Route::get('check-connection', [ADMIN_DASHBOARD_CONTROLLER, 'checkApiConnection'])->name(config('constants.ADMIN_PREFIX') . 'check_connection');
    Route::post('update-profile-request', [ADMIN_AUTH_CONTROLLER, 'updateProfileRequest'])->name(config('constants.ADMIN_PREFIX') . 'update_profile_request');
    Route::get('inventory-sync-now', [ADMIN_INVENTORY_CONTROLLER, 'syncNow'])->name(config('constants.ADMIN_PREFIX') . 'inventory_sync_now');
    Route::get('category-sync-now', [ADMIN_CATEGORY_CONTROLLER, 'syncNow'])->name(config('constants.ADMIN_PREFIX') . 'category_sync_now');
    Route::get('inventory-images-sync-now', [ADMIN_INVENTORY_CONTROLLER, 'syncImagesNow'])->name(config('constants.ADMIN_PREFIX') . 'inventory_images_sync_now');
    Route::get('inventory-changes-sync-now', [ADMIN_INVENTORY_CONTROLLER, 'syncChangesNow'])->name(config('constants.ADMIN_PREFIX') . 'inventory_changes_sync_now');
    Route::get('invoice-changes-sync-now', [ADMIN_INVOICE_CONTROLLER, 'syncChangesNow'])->name(config('constants.ADMIN_PREFIX') . 'invoice_changes_sync_now');
    Route::get('stores-sync-now', [ADMIN_STORE_CONTROLLER, 'syncChangesNow'])->name(config('constants.ADMIN_PREFIX') . 'stores_sync_now');
    Route::get('settings', [ADMIN_SETTINGS_CONTROLLER, 'index'])->name(config('constants.ADMIN_PREFIX') . 'settings');
    Route::get('category-status', [ADMIN_CATEGORY_CONTROLLER, 'changeStatus'])->name(config('constants.ADMIN_PREFIX') . 'category_status');
    Route::get('store-status', [ADMIN_STORE_CONTROLLER, 'changeStatus'])->name(config('constants.ADMIN_PREFIX') . 'store_status');
    Route::get('store-manager-status', [ADMIN_MANAGER_CONTROLLER, 'changeStatus'])->name(config('constants.ADMIN_PREFIX') . 'store_manager_status');
    Route::get('invoice-iframe/{id}', [ADMIN_INVOICE_CONTROLLER, 'invoiceIframe'])->name(config('constants.ADMIN_PREFIX') . 'invoice_iframe');
    Route::get('inventories-sync/{id}', [ADMIN_INVENTORY_CONTROLLER, 'syncSingleInventory'])->name(config('constants.ADMIN_PREFIX') . 'inventories_sync');
    Route::get('orders-re-mail/{id}', [ADMIN_ORDER_CONTROLLER, 'reMail'])->name(config('constants.ADMIN_PREFIX') . 'orders_re_mail');
    Route::get('invoices-excel/{id}', [ADMIN_INVOICE_CONTROLLER, 'exportExcel'])->name(config('constants.ADMIN_PREFIX') . 'invoices_excel');
    Route::get('orders-view-iframe/{id}', [ADMIN_ORDER_CONTROLLER, 'viewIframe'])->name(config('constants.ADMIN_PREFIX') . 'orders_iframe');

    //Module Routes
    $module_routes = [
        'role_management' => [
            'controller' => ADMIN_ROLE_CONTROLLER,
            'additional_routes' => []
        ],
        'portal_user_management' => [
            'controller' => ADMIN_PORTAL_USER_CONTROLLER,
            'additional_routes' => []
        ],
        'application_management' => [
            'controller' => ADMIN_APPLICATION_SETTING_CONTROLLER,
            'additional_routes' => []
        ],

        'inventories' => [
            'controller' => ADMIN_INVENTORY_CONTROLLER,
            'additional_routes' => []
        ],
        'categories' => [
            'controller' => ADMIN_CATEGORY_CONTROLLER,
            'additional_routes' => []
        ],
        'stores' => [
            'controller' => ADMIN_STORE_CONTROLLER,
            'additional_routes' => []
        ],
        'invoices' => [
            'controller' => ADMIN_INVOICE_CONTROLLER,
            'additional_routes' => []
        ],
        'custom_cron_jobs' => [
            'controller' => ADMIN_CRON_JOB_CONTROLLER,
            'additional_routes' => []
        ],
        'banners' => [
            'controller' => ADMIN_BANNER_CONTROLLER,
            'additional_routes' => []
        ],
        'store_managers' => [
            'controller' => ADMIN_MANAGER_CONTROLLER,
            'additional_routes' => []
        ],
        'orders' => [
            'controller' => ADMIN_ORDER_CONTROLLER,
            'additional_routes' => []
        ],
        'emails' => [
            'controller' => ADMIN_EMAIL_CONTROLLER,
            'additional_routes' => []
        ],
        'cms' => [
            'controller' => ADMIN_CMS_CONTROLLER,
            'additional_routes' => []
        ]
    ];


    foreach ($module_routes as $module_name => $module_route) {

        //Standard Routes
        Route::get($module_name . '_show', [$module_route['controller'], 'show'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_show');
        Route::get($module_name . '_dtListing', [$module_route['controller'], 'dtListing'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_dtListing');
        Route::get($module_name . '_add', [$module_route['controller'], 'add'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_add');
        Route::post($module_name . '_add', [$module_route['controller'], 'store'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_store');
        Route::get($module_name . '_edit/{id}', [$module_route['controller'], 'edit'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_edit');
        Route::post($module_name . '_edit', [$module_route['controller'], 'update'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_update');
        Route::get($module_name . '_delete/{id}', [$module_route['controller'], 'delete'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_delete');
        Route::get($module_name . '_view', [$module_route['controller'], 'view'])->name(config('constants.ADMIN_PREFIX') . $module_name . '_view');

        //Additional Routes

    }
});

