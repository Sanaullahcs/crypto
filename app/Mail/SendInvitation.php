<?php

namespace App\Mail;
use App\Models\RegisterInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    /**
     * Create a new message instance.
     */
    public function __construct(RegisterInvitation $invitation)
    {
        $this->invitation = $invitation;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('/register?invite=' . $this->invitation->unique_id);

        return $this->subject("Invitation to Register")->markdown('mail.Invitation', ['url' =>$url]);


    }
}
