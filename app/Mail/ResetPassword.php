<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    public $route;

    public function __construct($name, $token,$route = '')
    {
        $this->name = $name;
        $this->token = $token;
        $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name'] = $this->name;

        $user['token'] = $this->token;

        return $this->subject('Password Reset Link')
            ->view('emails.reset_password', ['user' => $user, 'route' => $this->route]);
    }
}
