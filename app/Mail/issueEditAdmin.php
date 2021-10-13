<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


//This email will be sent to a customer when an admin changes the status of his issue
class issueEditAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $issueTitle;
    public $adminName;
    public $customerName;
    public $newStatus;


    public function __construct($customerName,$adminName,$issueTitle,$newStatus)
    {
        $this->customerName=$customerName;
        $this->adminName=$adminName;
        $this->issueTitle=$issueTitle;
        $this->newStatus=$newStatus;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.issueEditAdmin');
    }
}
