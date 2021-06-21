<?php

namespace App\Mail;

use App\Apartment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $apartment;
    public $content;
    public $email_author;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Apartment $_apartment, String $_content, $_email_author)
    {
        $this->apartment = $_apartment;
        $this->content = $_content;
        $this->email_author = $_email_author;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.mails.send');
    }
}
