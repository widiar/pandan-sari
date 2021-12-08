@component('mail::message')
# Confirm Email

Silahkan klik link di bawah untuk konfirmasi email anda.
@component('mail::button', ['url' => $url, 'color' => 'success'])
Konfirmasi Email
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent