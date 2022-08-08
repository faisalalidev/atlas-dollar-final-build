<?php

namespace Database\Seeders;

use App\Models\ApplicationSetting;
use App\Models\Banner;
use App\Models\CMS;
use App\Models\CustomCronJob;
use App\Models\Email;
use App\Models\PortalModule;
use App\Models\PortalUser;
use App\Models\PortalUserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!PortalUserRole::count()) {
            PortalUserRole::create([
                'role_name' => 'Super Admin',
                'role_slug' => 'super_admin'
            ]);
        }

        if (!PortalUser::count()) {
            //Add single admin
            PortalUser::create([
                'name' => 'Super Admin',
                'email' => 'admin@atlasdollardeals.com',
                'role_slug' => 'super_admin',
                'password' => Hash::make('jjP^#KKYxh@XcCmBqiL5tZbm'),
                'email_verified_at' => Carbon::now(),
                'portal_login' => 1
            ]);
        }

        if (!CMS::count()) {
            //Add single admin
            CMS::create([
                'title' => 'About us',
                'slug' => 'about-us',
                'html' => '<h1>About Us</h1>'
            ]);
        }

        if (!Email::count()) {

            $email_data = [
                [
                    'title' => 'New Order',
                    'slug' => 'new_order',
                    'description' => 'New order emails are sent to chosen recipient(s) when a new order is received.',
                    'recipients' => 'os.sunesra@gmail.com,subhannizarcha@gmail.com',
                ],
                [
                    'title' => 'New User',
                    'slug' => 'new_user',
                    'description' => 'New customer emails are sent to chosen recipient(s) when a new customer signed up.',
                    'recipients' => 'os.sunesra@gmail.com,subhannizarcha@gmail.com',
                ]
            ];

            foreach ($email_data as $item) {
                Email::create($item);
            }
        }

        if (!ApplicationSetting::count()) {

            $application_settings_data = [
                [
                    'setting_name' => 'logo',
                    'setting_value' => 'admin_assets/img/logo.png',
                    'input_type' => 'image',
                ],
                [
                    'setting_name' => 'fav_icon',
                    'setting_value' => 'admin_assets/favicon.ico',
                    'input_type' => 'image',
                ],
                [
                    'setting_name' => 'application_name',
                    'setting_value' => 'Atlas Dollar Deals',
                    'input_type' => 'text',
                ],
                [
                    'setting_name' => 'description',
                    'setting_value' => 'Atlas Dollar Deals',
                    'input_type' => 'text',
                ],
                [
                    'setting_name' => 'default_title',
                    'setting_value' => 'Atlas Dollar Deals',
                    'input_type' => 'text',
                ],
                [
                    'setting_name' => 'keywords',
                    'setting_value' => 'Atlas Dollar Deals',
                    'input_type' => 'text',
                ],
                [
                    'setting_name' => 'reporter_emails',
                    'setting_value' => '',
                    'input_type' => 'tags_input',
                ],
                [
                    'setting_name' => 'phone',
                    'setting_value' => '0(800)123-456',
                    'input_type' => 'text',
                ]
            ];

            foreach ($application_settings_data as $item) {
                ApplicationSetting::create($item);
            }
        }

        if (!CustomCronJob::count()) {

            $cron_job_data = [
                [
                    'name' => 'Fetch Inventories and categories',
                    'time_to_execute' => '13:00',
                    'command' => 'inventories:get',
                ],
                [
                    'name' => 'Fetch Changes',
                    'time_to_execute' => '15:30',
                    'command' => 'inventories:changes',
                ],
                [
                    'name' => 'Fetch Inventory Images',
                    'time_to_execute' => '17:00',
                    'command' => 'inventories:images',
                ],
                [
                    'name' => 'Fetch Customers',
                    'time_to_execute' => '18:00',
                    'command' => 'customers:get',
                ],
                [
                    'name' => 'Fetch Invoices',
                    'time_to_execute' => '19:00',
                    'command' => 'invoice:changes',
                ]
            ];

            foreach ($cron_job_data as $item) {
                CustomCronJob::create($item);
            }
        }

        if (!Banner::count()) {

            $banners = [
                [
                    'text' => "<div class='banner-content y-50 text-right'><div class='slide-animate' data-animation-options=" . '"' . "{'name': 'fadeInUpShorter', 'duration': '1s'}" . '"' . "><h5 class='banner-subtitle text-uppercase font-weight-bold mb-2'>Deals AndPromotions</h5><h3 class='banner-title text-capitalize ls-25'><span class='text-primary'>Introducing</span><br>Fashion Lifestyle<br>Collection</h3><a href='demo8-shop.html' class='btn btn-dark btn-outline btn-rounded btn-icon-right'>Shop Now<i class='w-icon-long-arrow-right'></i></a></div></div>",
                    'type' => 'full_banner',
                    'image' => 'web_assets/images/demos/demo8/slides/slide-1.jpg',
                ],
                [
                    'text' => "<div class='banner-content y-50'><div class=slide-animate' data-animation-options=" . '"' . "{'name': 'flipInY', 'duration': '1s'}" . '"' . "><h5 class='banner-subtitle text-white text-uppercase font-weight-bold'>Smartphones</h5><h3 class='banner-title text-white text-capitalize mb-0 ls-25'>Sumsong Galaxy</h3><div class='banner-price-info text-white ls-25'>Up to <strong class='text-secondary text-uppercase'>30% Off</strong></div><p class='text-white'>Get Free Shipping on all orders over <strong class='font-weight-bold'>$199.99</strong></p><a href='demo8-shop.html' class='btn btn-white btn-outline btn-rounded btn-icon-right'>Shop Now<i class='w-icon-long-arrow-right'></i></a></div></div>",
                    'type' => 'full_banner',
                    'image' => 'web_assets/images/demos/demo8/slides/slide-2.jpg',
                ],
                [
                    'text' => "<div class='banner-content y-50'><div class='slide-animate' data-animation-options=" . '"' . "{'name': 'zoomIn', 'duration': '1s'}" . '"' . "><h5 class='banner-subtitle text-uppercase font-weight-normal text-secondary mb-2'>From online store</h5><h3 class='banner-title text-white text-capitalize'>Originals Comper<br>Star. Shoes</h3><hr class='divider bg-white'><p class='text-white text-uppercase mb-0 font-weight-bold'>for - Women<br><span class='font-weight-normal ls-normal'>Product Identifier: </span><span class='text-secondary ls-normal'>DD2098</span></p></div></div>",
                    'type' => 'full_banner',
                    'image' => 'web_assets/images/demos/demo8/slides/slide-3.jpg',
                ],
                [
                    'text' => "<div class='banner-content y-50'><h3 class='banner-title text-capitalize ls-25 mb-0'>For Men's</h3><div class='banner-price-info text-uppercase text-default ls-25 font-weight-bold'>Starting at <span class='text-secondary'>$29.00</span></div><hr class='banner-divider bg-dark'><a href='demo8-shop.html' class='btn btn-dark btn-link btn-outline btn-icon-right btn-slide-right'>Shop Now<i class='w-icon-long-arrow-right'></i></a></div>",
                    'type' => 'small_banner',
                    'image' => 'web_assets/images/demos/demo8/category/1-1.jpg',
                ],
                [
                    'text' => "<div class='banner-content text-center x-50 y-50 w-100 pl-2 pr-2' <h5 class='banner-subtitle text-primary text-capitalize ls-25 font-weight-bold'>Get 30% Off Your Entire Order!</h5><h3 class='banner-title text-white text-uppercase ls-25'>Black Friday Sale</h3><p>Use code <strong class='text-uppercase text-white'>Blkfri40</strong> at checkout.</p><a href='demo8-shop.html' class='btn btn-primary btn-outline btn-rounded btn-icon-right text-white btn-slide-right'>Shop Now<i class='w-icon-long-arrow-right'></i></a></div>",
                    'type' => 'small_banner',
                    'image' => 'web_assets/images/demos/demo8/category/1-2.jpg',
                ],
                [
                    'text' => "<div class='banner-content y-50'><h3 class='banner-title text-capitalize ls-25 mb-0'>For Women's</h3><div class='banner-price-info text-uppercase text-default ls-25 font-weight-bold'>From Only<span class='text-secondary'>$29.00</span></div><hr class='banner-divider bg-dark'><a href='demo8-shop.html' class='btn btn-dark btn-link btn-outline btn-icon-right btn-slide-right'>Shop Now<i class='w-icon-long-arrow-right'></i></a></div>",
                    'type' => 'small_banner',
                    'image' => 'web_assets/images/demos/demo8/category/1-3.jpg',
                ],

            ];

            foreach ($banners as $item) {
                Banner::create($item);
            }
        }

        PortalModule::query()->truncate();

        $modules = [
            [
                'module_name' => 'Dashboard',
                'module_slug' => 'dashboard',
                'module_icon' => 'icon material-icons md-home',
                'sort_number' => 1,
            ],
            [
                'module_name' => 'Role Management',
                'module_slug' => 'role_management',
                'module_icon' => 'icon material-icons md-verified_user',
                'sort_number' => 2,
            ],
            [
                'module_name' => 'User Management',
                'module_slug' => 'portal_user_management',
                'module_icon' => 'icon material-icons md-person',
                'sort_number' => 3,
            ],
            [
                'module_name' => 'Role Permission Management',
                'module_slug' => 'role_permission_management',
                'module_icon' => 'icon material-icons md-verified_user',
                'sort_number' => 4,
            ],
            [
                'module_name' => 'Inventory',
                'module_slug' => 'inventories',
                'module_icon' => 'icon material-icons md-shopping_bag',
                'sort_number' => 6,
            ],
            [
                'module_name' => 'Category',
                'module_slug' => 'categories',
                'module_icon' => 'icon material-icons md-add_box',
                'sort_number' => 7,
            ],
            [
                'module_name' => 'Store',
                'module_slug' => 'stores',
                'module_icon' => 'icon material-icons md-store',
                'sort_number' => 8,
            ],
            [
                'module_name' => 'Invoices',
                'module_slug' => 'invoices',
                'module_icon' => 'icon material-icons md-event_note',
                'sort_number' => 9,
            ],
            [
                'module_name' => 'Banners',
                'module_slug' => 'banners',
                'module_icon' => 'icon material-icons md-image',
                'sort_number' => 11,
            ],
            [
                'module_name' => 'Store Managers',
                'module_slug' => 'store_managers',
                'module_icon' => 'icon material-icons md-supervised_user_circle',
                'sort_number' => 12,
            ],
            [
                'module_name' => 'Order',
                'module_slug' => 'orders',
                'module_icon' => 'icon material-icons md-shopping_cart',
                'sort_number' => 13,
            ],
            [
                'module_name' => 'CMS',
                'module_slug' => 'cms',
                'module_icon' => 'icon material-icons md-pie_chart',
                'sort_number' => 15,
            ]
        ];

        foreach ($modules as $module) {
            PortalModule::create($module);
        }
    }
}
