<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->module_name = 'cms';
        $this->primary_model = new CMS();
    }

    public function view($slug)
    {
        $cms = $this->primary_model->where('slug',$slug)->first();

        if (!$cms){

            abort(404);
        }

        $this->dataAssign['html'] = $cms->html;

        $this->dataAssign['page_title'] = $cms->title;

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__ , $this->dataAssign);
    }
}
