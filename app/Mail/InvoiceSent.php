<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceSent extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $client;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $client)
    {
        $this->link = $link;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice for Payment')
            ->markdown('emails.send_invoice', [
                'link'     => $this->link,
                'client'     => $this->client,
            ]);
    }
}
