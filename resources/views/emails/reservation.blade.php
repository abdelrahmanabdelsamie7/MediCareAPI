@component('mail::message')
# 🏥 Appointment Confirmation

Dear **{{ $userName }}**,

Your **appointment has been successfully confirmed**! Below are your reservation details:

---

### 🩺 **Doctor Details**
👨‍⚕️ **Doctor:** {{ $doctorName }}
📍 **Clinic:** {{ $clinictitle }}

### 📅 **Appointment Details**
📆 **Date:** {{ $appointmentDate }}
⏰ **Time:** {{ $appointmentTime }}

---

@component('mail::button', ['url' => $reservationUrl, 'color' => 'success'])
📅 View Your Appointment
@endcomponent

If you need to **reschedule or cancel**, please contact us at **[Support Email]** or call **[Support Number]**.

Thank you for choosing **{{ config('app.name') }}**!
We look forward to serving you. 😊

Best Regards,
**{{ config('app.name') }} Team**
@endcomponent
