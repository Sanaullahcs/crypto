<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReciptOnEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscription;
    protected $userDetails;

    /**
     * Create a new message instance.
     *
     * @param $subscription
     * @param $userDetails
     */
    public function __construct($subscription, $userDetails)
    {
        $this->subscription = $subscription;
        $this->userDetails = $userDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.receipt-email')
            ->with([
                'subscription' => $this->subscription,
                'userDetails' => $this->userDetails,
            ])
            ->subject('Transaction Receipt');
    }
}
