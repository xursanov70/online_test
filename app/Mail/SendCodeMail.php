<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $rand;
    public function __construct($rand)
    {
        $this->rand = $rand;
    }

    public function build()
    {
        return $this->view('mail.send-code');
    }
}
