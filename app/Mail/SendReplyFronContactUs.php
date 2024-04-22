<?php

namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReplyFronContactUs  extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $message; // Add message as a public property

    /**
     * Create a new message instance.
     *
     * @param $contact
     * @param $messages
     */
    public function __construct(Contact $contact, $message)
    {
        $this->contact = $contact;
        $this->message = $message; // Assign the passed message to the property
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->markdown('mail.replycontactUs') // View for your email content
        ->with(['contact' => $this->contact, 'message' => $this->contact->message]) // Pass the message to the email template
        ->subject('Reply to Your Inquiry'); // Email subject
    }
}
