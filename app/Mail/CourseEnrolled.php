<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseEnrolled extends Mailable
{
    use Queueable, SerializesModels;

    public $enrollment;
    public $course;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enrollment, $course , $user)
    {
        //
        $this->enrollment =$enrollment;
        $this->course =$course;
        $this->user =$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.course_enrolled');
    }
}
