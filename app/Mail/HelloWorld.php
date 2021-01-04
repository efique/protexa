<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloWorld extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Date
     * @var string
     */
    public static $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $date)
    {
        self::$date = date("m/d/y");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.helloWorld');
    }
}
