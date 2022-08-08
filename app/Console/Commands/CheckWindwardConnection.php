<?php

namespace App\Console\Commands;

use App\Libraries\WindWard;
use App\Mail\WindwardConnectionErrorMail;
use App\Models\ApplicationSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckWindwardConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Windward Api Connection';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $windward = new WindWard();

        $application_setting_emails = ApplicationSetting::where('setting_name', 'reporter_emails')->first();

        $emails = explode(',', $application_setting_emails->setting_value);

        Log::info($emails);

        try {

            $response = $windward->getDataRequest('check-connection');

            $response = $response->result[0];

            if ($response->Response != 'Success') {

                $this->sendMail($emails);

            }

        } catch (\Exception $e) {

            Log::info($e->getMessage());

            $this->sendMail($emails);

        }
    }

    public function sendMail($emails)
    {
        if (!empty($emails)) {
            $error_message = 'Api hosted at [' . env('WINDWARD_URL') . '] is not responding.';

            Mail::to($emails)->send(new WindwardConnectionErrorMail($error_message));
        }
    }
}
