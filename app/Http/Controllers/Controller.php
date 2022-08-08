<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $module_directory;
    protected $module_name;

    public function __construct()
    {
        $this->module_directory = 'web';
    }

    protected function uploadImage($file, $folder_name = 'files')
    {
        $image_name = time() . uniqid() . '.' . $file->extension();

        $file->move(public_path($folder_name), $image_name);

        return $image_name;
    }
}
