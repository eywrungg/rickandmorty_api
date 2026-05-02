<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OtpMail extends Mailable
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = (string) $otp;
    }

    public function build()
    {
        return $this->subject('Your Registration OTP')->view('emails.otp')->with(['otp' => $this->otp]);
    }
}
