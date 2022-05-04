<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $distressCall;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /*  public function __construct(DistressCall $distressCall)
    {
        $this->distressCall = $distressCall;
    } */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('heribertolord@gmail.com', env('MAIL_FROM_NAME'))
            ->subject("Hola")
            ->view('mail.index');

        // return $this->view('mail.index');
    }
}