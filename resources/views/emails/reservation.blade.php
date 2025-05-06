@component('mail::message')
# 🏥 Appointment Confirmation

Dear **{{ $userName }}**,

Your **appointment has been successfully reserved**! Below are your reservation details:

---

### 🩺 **Doctor Details**
👨‍⚕️ **Doctor:** {{ $doctorName }}
---
📍 **Clinic:** {{ $clinictitle }}

### 📅 **Appointment Details**
📆 **Date:** {{ $appointmentDate }}
⏰ **Time:** {{ $appointmentTime }}

---

@component('mail::button', ['url' => $reservationUrl, 'color' => 'success'])
📅 View Your Appointment
@endcomponent

You can contact us at **medicare@gmail.com** or call **+20112908321**.

Thank you for choosing **MediCare**!
We look forward to serving you. 😊

Best Regards,
**MediCare Team**
@endcomponent
