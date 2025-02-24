<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $tieude;
    public $usemessage;
    /**
     * Create a new message instance.
     */
    public function __construct($name,$email,$tieude,$message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->tieude = $tieude;
        $this->usemessage = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
    return new Content(
        view: 'email.contact',
        with: [ 
            'name' => $this->name,
            'email' => $this->email,
            'tieude' => $this->tieude,
            'message' => $this->usemessage,
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
        return [];
    }
}
