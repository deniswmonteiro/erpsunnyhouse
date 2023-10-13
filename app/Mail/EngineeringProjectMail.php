<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EngineeringProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata, $type)
    {
        $this->maildata = $maildata;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 'store') {
            return $this->subject('E-mail de Sunny House')
                ->markdown('emails.engineeringProjectStore')
                ->with('maildata', $this->maildata);
        }

        else {
            return $this->subject('E-mail de Sunny House')
                ->markdown('emails.engineeringProjectUpdate')
                ->with('maildata', $this->maildata);
        }
    }
}
