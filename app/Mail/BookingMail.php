<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pathToPDF;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($pathToPDF)
     {
         $this->pathToPDF = $pathToPDF;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.BookingMail')->attach($this->pathToPDF,['as' => 'Booking.pdf']);
    }
}
