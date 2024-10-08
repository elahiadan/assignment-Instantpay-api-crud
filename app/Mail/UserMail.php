<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;


class UserMail extends Mailable
{
    use Queueable, SerializesModels;


    public $userMail;
    public $file = "2.png";
    public function __construct($userMail)
    {
        $this->userMail = $userMail;
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
        Log::alert("USER MAIL",[ $this->userMail->userEvent]);
        // need to create a file in views/email/index.blade.php
        return new Content(
            html: 'emails.index',
            // html: 'mail.orders.shipped', // use one of them view or html or markdown 
            // text: 'mail.orders.shipped-text',
            // only these fields are available in blade
            with: [
                'name' => $this->userMail->userEvent->name,
                'email' => $this->userMail->userEvent->email,
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
