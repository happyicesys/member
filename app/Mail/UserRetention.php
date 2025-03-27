<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class UserRetention extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('system@dcvend.com', 'DCVend System'),
            to: [new Address($this->user->email, $this->user->name)],
            subject: "{$this->user->name}, your membership is expiring soon",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.user-retention',
            with: ['user' => $this->user], // pass data to view if needed
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
