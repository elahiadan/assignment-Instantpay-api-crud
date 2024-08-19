<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BoardMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $boardMail;
    public $file = '2.png';
    public function __construct($boardMail)
    {
        $this->boardMail = $boardMail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('send_email@example.com', 'Email Send From this side'),
            replyTo: [
                new Address('reply_to_this_email@example.com', 'You can reply on this mail'),
            ],
            subject: 'This is testing email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::alert("BOARD MAIL", [$this->boardMail]);
        // need to create a file in views/email/index.blade.php
        return new Content(
            html: 'emails.board',
            // html: 'mail.orders.shipped', // use one of them view or html or markdown 
            // text: 'mail.orders.shipped-text',
            // only these fields are available in blade
            with: [
                'name' => $this->boardMail->name,
                "image" => public_path('images/' . $this->file),
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
