<?php

namespace App\Mail;

use App\Companies;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailTrap extends Mailable
{
    use Queueable, SerializesModels;
    protected $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //we could pass full object
    public function __construct($name)
    {
        $this->company = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mailtrap')->with("company", $this->company);
    }
}
