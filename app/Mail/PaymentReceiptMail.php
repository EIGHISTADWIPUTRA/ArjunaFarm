<?php

namespace App\Mail;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $details;
    public $result;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transaction, $details, $result)
    {
        $this->transaction = $transaction;
        $this->details = $details;
        $this->result = $result;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bukti Pembayaran Arjuna Farm - AR' . $this->transaction->order_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_receipt',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->generatePdf(), 'bukti-pembayaran-' . $this->transaction->order_id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
    
    /**
     * Generate PDF for payment receipt
     */
    protected function generatePdf()
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.payment_receipt', [
            'transaction' => $this->transaction,
            'details' => $this->details,
            'result' => $this->result
        ]);

        return $pdf->output();
    }
}
