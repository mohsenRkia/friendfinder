<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;
    protected $contactPm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactpm)
    {
        $this->contactPm = $contactpm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pm = $this->contactPm;
        return $this->view('v1.mail.contact',compact(['pm']));
    }
}
