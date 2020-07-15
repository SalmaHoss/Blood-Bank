<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $code;
    /**
     * Create a new message instance.
     *
     * @param $code
     */
    public function __construct($code)
    {
        //
        $this->code = $code;
    }
//C:\xampp\htdocs\blood_bank_v1>php artisan make:mail ResetPassword --markdown=email.auth.reset
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.auth.reset',['code'=>$this->code]);
    }
}
