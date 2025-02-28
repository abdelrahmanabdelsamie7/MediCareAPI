@component('mail::message')
# 🎉 Payment Confirmation

Hello **{{ $userName }}**,

We are pleased to inform you that your payment for the appointment with **Dr. {{ $doctorName }}** has been **successfully processed!** 💳✅

## 🗓 Appointment Details
📅 **Date:** {{ $appointmentDate }}
⏰ **Time:** {{ $appointmentTime }}
💰 **Price:** {{ $reservationPrice }}
⏳ **Duration:** {{ $reservationDuration }}

@component('mail::panel')
Your appointment is confirmed! Make sure to be on time. If you need to reschedule, check your reservation details.
@endcomponent

@component('mail::button', ['url' => $reservationUrl, 'color' => 'success'])
🔍 View Your Reservation
@endcomponent

If you have any questions, feel free to contact us.

**Thank you for choosing our service!** 🙌

Best regards,
**{{ config('app.name') }}**
@endcomponent
