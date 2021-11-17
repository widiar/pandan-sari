@component('mail::message')
# Confirm Email

Silahkan klik link di bawah untuk konfirmasi email anda
Batas link dapat dibuka adalah 1 jam
@component('mail::button', ['url' => $url, 'color' => 'success'])
konfirmasi Email
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent