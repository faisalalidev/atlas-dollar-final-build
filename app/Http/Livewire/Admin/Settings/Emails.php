<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\ApplicationSetting;
use App\Models\Email;
use Livewire\Component;

class Emails extends Component
{
    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->email_model = new Email();
    }

    public function updateEmails($form_data)
    {
        foreach ($form_data as $key => $data){

            $this->email_model->where('slug',$key)->update(['recipients' => $data]);
        }

        ApplicationSetting::where('setting_name','reporter_emails')->update(['setting_value' => $form_data['reporter_email']]);
    }

    public function render()
    {
        $emails = $this->email_model->get();

        $reporter_email = ApplicationSetting::where('setting_name','reporter_emails')->first();

        return view('livewire.admin.settings.emails',['emails' => $emails,'reporter_email' => $reporter_email]);
    }
}
