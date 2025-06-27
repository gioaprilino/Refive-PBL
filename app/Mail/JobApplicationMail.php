<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $cvPath;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $cvPath)
    {
        $this->data = $data;
        $this->cvPath = $cvPath;
    }

    public function build()
    {
        return $this->subject('Lamaran Pekerjaan: ' . $this->data['job_title'])
            ->view('emails.job-application')
            ->attachFromStorageDisk('public', $this->cvPath, 'CV_' . $this->data['name'] . '.' . pathinfo($this->cvPath, PATHINFO_EXTENSION));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Application Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
