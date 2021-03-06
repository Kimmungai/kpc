<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcurementReport extends Mailable
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
      return $this->view('emails.ProcurementReport')->attach($this->pathToPDF,['as' => date('d-M-Y').' Procurement Report.pdf']);
    }
}
