<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        $reservationUrl= 'http://localhost:4200/all/user-reservations';
        return $this->subject('Payment Successful!')
            ->markdown('emails.payment_success')
            ->with([
                'userName' => $this->reservation->user->name,
                'doctorName' => $this->reservation->doctor->fName . ' ' . $this->reservation->doctor->lName,
                'appointmentDate' => $this->reservation->appointment->day,
                'appointmentTime' => Carbon::createFromFormat('H:i:s', $this->reservation->appointment->start_at)->format('g:i A') .' - ' . Carbon::createFromFormat('H:i:s', $this->reservation->appointment->end_at)->format('g:i A'),
                'reservationId' => $this->reservation->id,
                'reservationUrl' => $reservationUrl,
                'reservationPrice' => $this->reservation->final_price,
                'reservationDuration' => $this->reservation->appointment->duration,
            ]);
    }
}

