<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $user;

    public function __construct($reservation, $user)
    {
        $this->reservation = $reservation;
        $this->user = $user;
    }

    public function build()
    {
        $reservationUrl = 'http://localhost:4200/all/user-reservations';
        return $this->subject('Your Reservation Confirmation')
            ->markdown('emails.reservation')
            ->with([
                'userName' => $this->user->name,
                'doctorName' => $this->reservation->doctor->fName . ' ' . $this->reservation->doctor->lName,
                'appointmentDate' => $this->reservation->appointment->day,
                'appointmentTime' => Carbon::createFromFormat('H:i:s', $this->reservation->appointment->start_at)->format('g:i A') .' - ' . Carbon::createFromFormat('H:i:s', $this->reservation->appointment->end_at)->format('g:i A'),
                'clinictitle' => $this->reservation->clinic->title,
                'reservationUrl' => $reservationUrl,
                'reservationId' => $this->reservation->id,
            ]);
    }
}
