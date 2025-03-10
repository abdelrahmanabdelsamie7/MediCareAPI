@component('mail::message')
# Reset Your Password

Hello {{ $user->name }},

We received a request to reset your password. Click the button below to set a new one:

@component('mail::button', ['url' => url('http://localhost:4200/reset-password?token=' . $token)])
Reset Password
@endcomponent

This link will expire in 1 hour for your security.

If you didn’t request this reset, you can safely ignore this email. Your password will remain unchanged.

Thanks,
The Medicare Team
@endcomponent
