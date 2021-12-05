@component('mail::message')
# Pembayaran Telah Ditolak!

Pembayaran dengan nomor Invoice <strong style="color: #0c62e2;">{{ $nomor }}</strong> Telah di Tolak!<br>
Silahkan upload ulang bukti pembayaran pada menu Transaksi.
@component('mail::button', ['url' => $url, 'color' => 'primary'])
Transaksi
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent