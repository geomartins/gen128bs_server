<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@gen128bs.com')
                    ->view('emails.contact')
                    ->subject('Contact Message Update')
                    ->with([
                        'firstname' => $this->data['firstname'],
                        'lastname' => $this->data['lastname'],
                        'company' => $this->data['company'],
                        'reason' => $this->data['reason'],
                        'email' => $this->data['email'],                        
                    ]);
    }
}
