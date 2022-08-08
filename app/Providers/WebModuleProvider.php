<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CMS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class WebModuleProvider extends ServiceProvider
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
        $category_model_obj = new Category();

        $cms_model_obj = new CMS();

        $data_to_share['categories'] = [];

        $data_to_share['cms'] = [];

        if(Schema::hasTable($category_model_obj->getTable())) {

            $data = $category_model_obj->with(['childs','childs.inventories'])->whereNull('parent')->where('active',1)->orderBy('name','ASC')->limit(11)->get();

            $data_to_share['categories'] = $data;

        }

        if(Schema::hasTable($cms_model_obj->getTable())) {

            $data = $cms_model_obj->get();

            $data_to_share['cms'] = $data;
        }

        view()->composer('web*', function ($view) use ($data_to_share) {
            $view->with($data_to_share);
        });

    }
}
