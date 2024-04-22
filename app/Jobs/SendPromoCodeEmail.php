<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendPromoCodeEmail as MailSendPromoCodeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPromoCodeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emails;
    public $code;
    /**
     * Create a new job instance.
     */
    public function __construct($emails, $code)
    {
        $this->code = $code;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emails = $this->emails;
        foreach ($emails as $email) {
            Mail::to($email)->send(new MailSendPromoCodeEmail($email, $this->code));
        }
    }
}
