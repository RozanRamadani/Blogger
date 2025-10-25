<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(protected Contact $contact)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('app.name')),
            subject: 'New Contact Message',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-received',
            with: [
                'name' => $this->contact->name,
                'email' => $this->contact->email,
                'contact_message' => $this->contact->message,
            ]
        );
    }
}
