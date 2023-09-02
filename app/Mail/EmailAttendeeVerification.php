<?php

namespace App\Mail;

use App\Models\EventAttendee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL as FacadesURL;
use PharIo\Manifest\Url;

class EmailAttendeeVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $event_attendee;
    public $link;

    public function __construct(EventAttendee $event_attendee)
    {
        $now = now();
        $this->event_attendee = $event_attendee;
        $this->event_attendee->load('event.date_time');
        $this->link = FacadesURL::temporarySignedRoute('attendees.verification', $now->addHour(), ['attendee' => $event_attendee->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('inventive.media@gmail.com', 'Henry Ong'),
            subject: 'Email Attendee Verification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.events.attendee-verification',
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
