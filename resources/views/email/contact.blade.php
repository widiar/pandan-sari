@component('mail::message')
# Email from {{ $nama }}

Email : {{ $email }}
<br>

@component('mail::panel')
{{ $pesan }}
@endcomponent


@endcomponent