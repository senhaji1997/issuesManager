<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


//This email will be sent to the customor when he submittes a new issue to inform him that the issue has been created successfully
class issueSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $issueTitle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName,$issueTitle)
    {
        $this->customerName=$customerName;
        $this->issueTitle=$issueTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.issueSubmittedMail');
    }
}
