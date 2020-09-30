<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Invoice;
use App\Models\Project;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice    = $invoice;
        $this->project    = Project::findOrfail($invoice->project_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice for Payment')
            ->markdown('emails.invoice.sent', [
                'invoices'     => $this->invoice,
                'project'      => $this->project
            ]);
    }
}
