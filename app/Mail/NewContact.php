<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable /* oggetto Mailable, ovvero il messaggio email da inviare */
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

public $lead; /* variabile di istanza che memorizza tutti i dati del form, va definita come ublic in modo da potervi accedere direttamente dalla view */
    public function __construct($_lead)
    {
        $this->lead = $_lead; 
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact',
            replyTo: $this->lead->address // email del mittente: il valore di ritorno è un oggetto della classe Envelope
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.new-contact', //ritorna una view che va creata dentro la cartella emails
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
