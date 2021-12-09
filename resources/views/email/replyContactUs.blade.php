@component('mail::message')
# Terimakasih Telah Menghubungi Kami !

Hai, <b>{{ $nama }}!</b><br>
Terimakasih sudah menghubungi kami melalui fitur Contact Us.

@component('mail::panel')
{{ $pesan }}
@endcomponent

Terkait hal diatas kami ingin memberitahukan bahwa: <br>
{{ $pesanBalas }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent