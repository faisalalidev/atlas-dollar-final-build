<?php

namespace App\Providers;

use App\Models\ApplicationSetting;
use App\Models\PortalModule;
use App\Models\PortalUserModulePermission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AdminModuleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $portal_module_model_obj = new PortalModule();

        if(Schema::hasTable($portal_module_model_obj->getTable())) {

            $data_to_share = [];

            $data_to_share['modules'] = $portal_module_model_obj->orderBy('sort_number')->get();

            view()->composer('admin_*', function ($view) use ($data_to_share) {
                $view->with($data_to_share);
            });

        }

        $app_setting_model_obj = new ApplicationSetting();

        if(Schema::hasTable($app_setting_model_obj->getTable())) {

            $data_array = [];

            $data_to_share = [];

            $data = $app_setting_model_obj->get();

            foreach ($data as $item){

                $data_array[$item->setting_name] = $item->setting_value;
            }

            $data_to_share['app_settings'] = $data_array;

            view()->composer('*', function ($view) use ($data_to_share) {
                $view->with($data_to_share);
            });

        }
    }
}
