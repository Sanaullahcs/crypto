<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPromoCodeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $code;
    /**
     * Create a new message instance.
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info('Sending promo code email to: ' . $this->email);
        return $this->subject("Crypto Wiz Guy Discount Code!")->markdown('mail.promocode-email', ['code' => $this->code, 'email' => $this->email]);
    }
}
