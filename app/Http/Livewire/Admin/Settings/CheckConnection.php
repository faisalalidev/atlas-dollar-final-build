<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Libraries\WindWard;
use Livewire\Component;

class CheckConnection extends Component
{
    public $error = false;
    public $success = false;

    public function checkApiConnection($form_data)
    {
        $this->success = false;
        $this->error = false;

        $windward = new WindWard();

        try {

            $response = $windward->getDataRequest('check-connection','',$form_data);

            $response = $response->result[0];

            if ($response->Response == 'Success') {

               $this->success = true;

            } else {

                $this->error = true;
            }

        } catch (\Exception $e) {

            $this->error = true;
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.check-connection');
    }
}
