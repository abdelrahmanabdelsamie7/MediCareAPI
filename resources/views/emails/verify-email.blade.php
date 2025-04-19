@component('mail::message')
    # Hello {{ $userName }},

    Thank you for registering! Please verify your email by clicking the button below.
    This link is valid for **30 minutes**.

    @component('mail::button', ['url' => $verificationUrl, 'color' => 'success'])
        Verify Email
    @endcomponent

    If you did not create this account, please ignore this email.

    Thanks , MediCare
@endcomponent
