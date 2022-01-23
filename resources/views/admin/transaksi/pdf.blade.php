<!DOCTYPE html>
<html lang="id">

<head>
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        .content-area>div {
            width: auto !important;
            margin: 0 auto !important;
        }

        @media print {
            body {
                padding-top: 0;
            }

            #action-area {
                display: none;
            }
        }
    </style>
</head>

<body
    style="font-family: open sans, tahoma, sans-serif; margin: 0; -webkit-print-color-adjust: exact; padding: 30px;">

    <div class="content-area">
        @php
        $total = 0;
        @endphp
        <div style="background-size: contain;">
            @foreach($invoice as $inv)
            @php
            $total += $inv->total;
            @endphp
            <table width="100%" cellspacing="0" cellpadding="0"
                style="width: 100%; padding: 25px 32px; color: #343030; margin-bottom: 35px">
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0"
                            style="border-bottom: thin dashed #cccccc; padding-left: 50px">
                            <tr>
                                <td style="width: 57%; vertical-align: top;">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td colspan="2" style="font-size: 14px;">
                                                <span style="font-weight: 600">Nomor Invoice</span> : <span
                                                    style="color: #0c62e2; font-weight: 600;">{{ $inv->nomor }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td
                                                style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 120px; padding-top: 15px;">
                                                Tanggal Bayar</td>
                                            <td style="font-size: 12px; padding-bottom: 6px; padding-top: 15px;">
                                                {{ date('d F Y', strtotime($inv->updated_at)) }}</td>
                                        </tr>




                                    </table>
                                </td>
                                <td style="width: 43%; vertical-align: top; padding-left: 30px;">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="font-weight: 600; font-size: 14px;padding-bottom: 8px;">
                                                Identitas Pembeli:</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; padding-bottom: 20px;">
                                                <span style="margin-bottom: 3px; font-weight: 600; display: block;">{{
                                                    $inv->user->nama }}</span>
                                                <div>
                                                    {{ $inv->user->alamat }}
                                                    <br>
                                                    {{ $inv->user->no_tlp }}
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0"
                            style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; margin-top: 20px;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74); font-size: 14px; font-weight: 600;">
                                <td style="padding: 10px 15px;">Nama Wisata</td>
                                <td style="padding: 10px 15px; text-align: center;">Tanggal</td>
                                <td style="padding: 10px 15px; text-align: center;">Jumlah</td>
                                <td style="padding: 10px 15px; text-align: center; white-space: nowrap;">Harga</td>
                                <td style="padding: 10px 15px; text-align: right;">Subtotal</td>
                            </tr>


                            <!-- looping -->
                            @foreach($inv->cart as $cart)
                            <tr style="font-size: 14px;">
                                <td width="330" style="padding: 15px; font-weight: 600; word-break: break-word;">
                                    <a href="{{ route('detail', $cart->watersport_id) }}">{{ $cart->watersport->nama
                                        }}</a>

                                    <div style="margin: 10px 0 0;">

                                    </div>



                                </td>
                                <td valign="top" style="padding: 15px; text-align: center;">
                                    {{ date('j F Y', strtotime($cart->tanggal)) }}
                                </td>
                                <td valign="top" style="padding: 15px; text-align: center;">
                                    {{ $cart->jumlah }}
                                </td>
                                <td valign="top" style="padding: 15px; white-space: nowrap; text-align: center;">
                                    Rp {{ number_format($cart->satuan, 0, ',', '.') }}
                                </td>
                                <td valign="top" style="padding: 15px; white-space: nowrap; text-align: right;">
                                    Rp {{ number_format($cart->total, 0, ',', '.') }}
                                </td>
                            </tr>


                            <tr>
                                <td colspan="5" style="padding: 0 15px;">
                                    <div style="border-bottom: thin solid #e0e0e0"></div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- end looping -->



                            <tr>
                                <td></td>
                                <td colspan="4">
                                    <table width="100%" cellspacing="0" cellpadding="0"
                                        style="padding-right: 15px; font-size: 14px; font-weight: 600;">
                                        <tr>
                                            <td colspan="2">
                                                <div style="border-bottom: thin solid #e0e0e0"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 15px;">Total</td>
                                            <td style="padding: 15px 0 15px 15px; text-align: right;">
                                                Rp {{ number_format($inv->total, 0, ',', '.') }} </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


                <!-- refactor div float left and right in case order is kelontong -->
            </table>
            @endforeach
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>

                        <div style="float:right;">
                            <table>

                                <!-- total belanja -->

                                <tr>
                                    <td>
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="width: 50%;"></td>
                                                <td style="width: 50%;">
                                                    <table width="100%"
                                                        style="width: 430px; padding: 15px; border-radius: 4px; border: thin solid rgba(0, 0, 0, 0.54); font-size: 14px; font-weight: 600;">
                                                        <tr>
                                                            <td>Total Pendapatan</td>
                                                            <td style="text-align: right;">
                                                                Rp {{ number_format($total, 0, ',', '.') }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>


                                <!-- subtotal nilai tukar tambah -->



                                <!-- subtotal nilai promo -->

                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


</html>