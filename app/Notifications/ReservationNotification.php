<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
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
            'start_appointment' => $this->reservationData['start_appointment'],
            'end_appointment' => $this->reservationData['end_appointment'],
            'duration_appointment' => $this->reservationData['duration_appointment'],
        ];
    }



    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('حجز موعد جديد')
    //         ->line($this->reservationData['message'])
    //         ->line('الدكتور: ' . $this->reservationData['doctor_name'])
    //         ->line('المستخدم: ' . $this->reservationData['user_name'])
    //         ->line('التوقيت: ' . $this->reservationData['appointment_time'])
    //         ->line('الحالة: ' . $this->reservationData['status']);
    // }
}
