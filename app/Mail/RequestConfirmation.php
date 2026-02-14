<?php

namespace App\Mail;

use App\Models\ITRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $itRequest;

    public function __construct(ITRequest $itRequest)
    {
        $this->itRequest = $itRequest;
    }

    public function build()
    {
        return this->subject('We Received Your IT Request: #' . $this->itRequest->id)
                    ->markdown('emails.requests.confirmation');
    }
}
