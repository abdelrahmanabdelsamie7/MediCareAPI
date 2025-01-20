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
            'appointment_time' => $this->reservationData['appointment_time'],
            'status' => $this->reservationData['status'],
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
