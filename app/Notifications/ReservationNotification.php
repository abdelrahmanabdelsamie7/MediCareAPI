<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
class ReservationNotification extends Notification
{
    use Queueable;
    private $reservationData;
    public function __construct($reservationData)
    {
        $this->reservationData = $reservationData;
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->reservationData['message'],
            'doctor_name' => $this->reservationData['doctor_name'],
            'user_name' => $this->reservationData['user_name'],
            'user_phone' => $this->reservationData['user_phone'],
            'user_address' => $this->reservationData['user_address'],
            'appointment_day' => $this->reservationData['appointment_day'],
            'start_appointment' => $this->reservationData['start_appointment'],
            'end_appointment' => $this->reservationData['end_appointment'],
            'duration_appointment' => $this->reservationData['duration_appointment'],
            'reservation_id' => $this->reservationData['reservation_id'],
             'final_price' =>$this->reservationData['final_price'],
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
        ];
    }
}