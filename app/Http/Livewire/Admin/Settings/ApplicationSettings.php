<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\ApplicationSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Symfony\Component\Translation\t;

class ApplicationSettings extends Component
{
    use WithFileUploads;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->primary_model = new ApplicationSetting();
    }

    public $logo;
    public $fav_icon;

    public function updateSettings($form_data)
    {
        foreach ($form_data as $setting_name => $setting) {

            if (!empty($setting)){

                $this->primary_model->where('setting_name',$setting_name)->update(['setting_value' => $setting]);

            }
        }

        if ($this->logo){

            $this->primary_model->where('setting_name','logo')->update(['setting_value' => 'storage/files/'.$this->uploadImage($this->logo)]);

        }

        if ($this->fav_icon){

            $this->primary_model->where('setting_name','fav_icon')->update(['setting_value' => 'storage/files/'.$this->uploadImage($this->fav_icon)]);

        }
    }

    protected function uploadImage($file, $folder_name = 'public/files')
    {
        $image_name = time() . uniqid() . '.' . $file->extension();

        $file->storeAs($folder_name , $image_name);

        return $image_name;
    }

    public function render()
    {
        $settings = $this->primary_model->get();

        return view('livewire.admin.settings.application-settings',['data' => $settings]);
    }
}
