<?php

function hasPermission($module_slug, $role_slug, $permission)
{
    if ($role_slug == \Illuminate\Support\Facades\Config::get('constants.ALL_PRIVILEGE_ROLE_SLUG')) {
        return true;
    }

    return \App\Models\PortalUserModulePermission::where('module_slug', $module_slug)
        ->where('role_slug', $role_slug)
        ->where($permission, 1)
        ->count();

}

function getAppSetting($setting_name)
{

    $setting = \App\Models\ApplicationSetting::where('setting_name', $setting_name)->first();

    return $setting->setting_value;
}

function getLoggedInUser()
{
    return auth()->guard(config('constants.WEB_GUARD_NAME'))->user();
}

function getUserStoreAddress($user = null)
{
    if (!$user){

        $user = getLoggedInUser();
    }

    if ($user->store && count($user->store->contacts)) {

        return $user->store->contacts[0];
    }

    return null;
}

function getRouteName()
{
    return request()->route()->getName();

}

function convertImageBlob($image_name, $blob)
{
    $fp = fopen(public_path('files/' . $image_name), "wb");

    $len = count($blob);

    for ($i = 0; $i < $len; $i++) {

        $chunks = pack("C*", $blob[$i]);

        fwrite($fp, $chunks);
    }
    fclose($fp);
}

function addCurrencyToPrice($price)
{

    return '$' . $price;
}


