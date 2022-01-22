@component('mail::message')
# Reset Password

Silahkan klik link di bawah untuk mereset password anda
Batas link dapat dibuka adalah 1 jam
@component('mail::button', ['url' => $url, 'color' => 'success'])
Reset Password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent