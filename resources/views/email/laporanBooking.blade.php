@component('mail::message')
# Laporan Booking.

Pembayaran dari <b>{{ $invoice->user->nama }}</b> Sudah di Terima!<br>

<b>Berikut detail dari identitas pembeli</b>
<table>
    <tr>
        <td>Nama Lengkap</td>
        <td>: {{ $invoice->user->nama }}</td>
    </tr>
    <tr>
        <td>No Telpon</td>
        <td>: {{ $invoice->user->no_tlp }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: {{ $invoice->user->alamat }}</td>
    </tr>
</table>

<br>
<b>Berikut detail pesanan</b>
@component('mail::table')
| Wisata | Tanggal | Jumlah | Harga | Subtotal |
| :------------- | :------------: | :------------: | :--------:| -------: |
@foreach($invoice->cart as $cart)
| {{ $cart->watersport->nama }} | {{ date('j F Y', strtotime($cart->tanggal)) }} | {{ $cart->jumlah }} | Rp {{ number_format($cart->satuan, 0, ',', '.') }} | Rp {{ number_format($cart->total, 0, ',', '.') }} |
@endforeach
| | | | <p style="text-align: left">Total</p> | <p style="color: rgb(255, 81, 0); text-align: right;"> Rp. {{ number_format($invoice->total, 0, ',', '.') }}</p> |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent