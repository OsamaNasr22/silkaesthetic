<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $data;
    public function __construct(array $data)
    {
        //

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->to('os.ns2013@gmail.com')->from($this->data['sender'])->subject('New message');
        return $this->markdown('emails.sendMessage')->with([
            'message'=>$this->data['message'],
            'sender'=>$this->data['sender'],
            'name'=>$this->data['name'],
            'phone'=>$this->data['phone'],
        ]);
    }
}
