<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationSuccessfulMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdfContent;

    public function __construct($data, $pdfContent)
    {
        $this->data = $data;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->view('emails.application_successful')
            ->with($this->data)
            ->attachData($this->pdfContent, "COC_LETTER_" . $this->data['coc_no'] . ".pdf", [
                'mime' => 'application/pdf',
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CTPL Insurance Policy - Application Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.application-successful',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
