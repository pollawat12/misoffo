<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPwMail extends Mailable
{
    use Queueable, SerializesModels;

    public $template;

    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $contents)
    {
        $this->template = $template;
        $this->content = $contents;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->template, $this->content)
        ->subject($this->content['subject'])
        ->from('no_reply@misoffo.com', 'Notification By Misoffo Appcliction');
    }
}
