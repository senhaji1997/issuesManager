<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//This email will be sent to all admins when a customer changes the status of an issue
class issueEditCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $issueTitle;
    public $customerName;

    public function __construct($customerName,$issueTitle)
    {
        $this->issueTitle=$issueTitle;
        $this->customerName=$customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.issueEditCustomer');
    }
}
