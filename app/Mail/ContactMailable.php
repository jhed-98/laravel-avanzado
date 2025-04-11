<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['name']),
            subject: 'Contact Mailable',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //! HTML
        // return new Content(
        //     view: 'mails.contact',
        // );
        //! Markdown
        return new Content(
            markdown: 'mails.contact-md',
            with: [
                'data' => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // return [$this->data['file']];
        //! Enviando archivo sin cola queue
        // return  [
        //     Attachment::fromPath($this->data['file']->getRealPath())
        //         ->as($this->data['file']->getClientOriginalName())
        //         ->withMime($this->data['file']->getMimeType())
        // ];
        //! Enviando archivo en cola
        // return [
        //     Attachment::fromStorage($this->data['file']),
        // ];
        //! Verificando si se envia File
        if (isset($this->data['file'])) {
            return [
                Attachment::fromStorageDisk('public', $this->data['file']),
            ];
        }
        return [];
    }
}
