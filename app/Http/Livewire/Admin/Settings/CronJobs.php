<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\CustomCronJob;
use Livewire\Component;

class CronJobs extends Component
{
    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->primary_model = new CustomCronJob();
    }

    public function updateCron($form_data)
    {
        $this->primary_model->find($form_data['id'])->update(['time_to_execute' => date('H:i',strtotime($form_data['time_to_execute']))]);

        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        $crons = $this->primary_model->get();

        return view('livewire.admin.settings.cron-jobs',['crons' => $crons]);
    }
}
