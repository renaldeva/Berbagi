<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode;

    public function __construct($otpCode)
    {
        $this->otpCode = $otpCode;
    }

    public function build()
    {
        return $this->subject('OTP Verifikasi Email Berbagi')
                    ->html("<p>Kode OTP Anda: <b>{$this->otpCode}</b></p><p>Berlaku 2 menit.</p>");
    }
}
