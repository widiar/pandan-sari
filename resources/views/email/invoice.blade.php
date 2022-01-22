@component('mail::message')
# Pembayaran Berhasil !

Pembayaran Sudah di Terima!<br>
Terimakasih sudah melakukan booking di Pandan Sari.

No. Invoice :
@component('mail::panel')
<a href="{{ route('mail.invoice', ['nomor'=>$invoice->nomor]) }}" target="_blank">{{ $invoice->nomor }}</a>
@endcomponent

@component('mail::table')
| Wisata | Tanggal | Jumlah | Harga | Subtotal |
| :------------- | :------------: | :------------: | :--------:| -------: |
@foreach($invoice->cart as $cart)
| {{ $cart->watersport->nama }} | {{ date('j F Y', strtotime($cart->tanggal)) . " " . $cart->jam }} | {{ $cart->jumlah }} | Rp {{ number_format($cart->satuan, 0, ',', '.') }} | Rp {{ number_format($cart->total, 0, ',', '.') }} |
@endforeach
| | | | <p style="text-align: left">Total</p> | <p style="color: rgb(255, 81, 0); text-align: right;"> Rp. {{ number_format($invoice->total, 0, ',', '.') }}</p> |
@endcomponent

Bukti pembayaran ini merupakan bukti yang sah.

Thanks,<br>
{{ config('app.name') }}
@endcomponent