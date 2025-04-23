<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class RegisteredUsers extends Mailable
{
    use Queueable, SerializesModels;

    protected string $remotePath;
    protected array $data;

    public function __construct(string $remotePath, array $data = [])
    {
        $this->remotePath = $remotePath;
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('system@dcvend.com', 'DCVend System'),
            subject: 'DCVend Registered Users'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.simple-registered-users',
            with: [
                'data' => $this->data,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('digitaloceanspaces', $this->remotePath)
                ->as('registered_users.xlsx')
                ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
        ];
    }
}
