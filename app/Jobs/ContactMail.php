<?php

namespace App\Jobs;

use App\Mail\MailContact;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ContactMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $contactpm;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name,$email,$contactpm)
    {
        $this->name = $name;
        $this->email = $email;
        $this->contactpm = $contactpm;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->name;
        $email = $this->email;
        $contactpm = $this->contactpm;
        $to[] = ['email' => $email,'name' => $name];
        Mail::to($to)->send(new MailContact($contactpm));
    }
}
