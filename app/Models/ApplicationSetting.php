<?php

namespace App\Models;

use App\Mail\WindwardConnectionErrorMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class ApplicationSetting extends Model
{
    use HasFactory;

    protected $fillable = ['setting_name', 'setting_value', 'input_type'];

    public static function sendErrorResponseToAdminEmails($error_message)
    {
        $application_setting_emails = ApplicationSetting::where('setting_name', 'reporter_emails')->first();

        $emails = explode(',', $application_setting_emails->setting_value);

        if (!empty($emails)) {
            Mail::to($emails)->send(new WindwardConnectionErrorMail($error_message));
        }
    }
}
