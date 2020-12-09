<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResultModified extends Mailable
{
    use Queueable, SerializesModels;

    public $results ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($results)
    {
        //
        $this->results = $results;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.results-modified');
    }
}
