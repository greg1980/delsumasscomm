<?php

namespace App\Mail;

use App\ActivationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public  $url;

    /**
     * Create a new message instance.
     *
     * @param ActivationCode $code
     */
    public function __construct(ActivationCode $code)
    {
        //

        $this->code = $code;
        $this->url = route('user.activation', $this->code);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_activation');
    }
}
