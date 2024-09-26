<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CarRentalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $customerName, $carName, $beginDate, $endDate,$totalAmount, $bookingID;
    /**
     * Create a new message instance.
     */
    public function __construct($customerName, $carName, $beginDate, $endDate,$totalAmount)
    {
        $this->customerName = $customerName;
        $this->carName = $carName;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->totalAmount = $totalAmount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Car Rental Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.CarRentalMail',
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
