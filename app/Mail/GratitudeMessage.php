<?php

namespace App\Mail;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class GratitudeMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $attendee;
    public $event;

    public function __construct(Event $event, Attendee $attendee)
    {
        $this->attendee = $attendee;
        $this->event = $event;
        $this->event->load('location', 'date_time', 'organizer');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('inventive.media@gmail.com', 'Henry Ong'),
            subject: 'Thank You for Attending',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.events.thankyou-attendee',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        // return Attachment::fromStorageDisk('public', '/storage/calendar.png');
    }
}
