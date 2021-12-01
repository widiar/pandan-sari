@extends('layout.template')

@section('title')
Home Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
    .gtco-cover {
        height: 500px !important
    }

    .header-date {
        margin: auto;
        width: 90%;
        height: 15%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .date {
        font-size: 20px;
        font-weight: 700;
        color: #2F3841;
    }

    .remove-all {
        font-size: 14px;
        font-weight: 600;
        color: #E44C4C;
        cursor: pointer;
        border-bottom: 1px solid #E44C4C;
    }

    .cart-items {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        height: 30%;
        margin: 20px;
    }

    .image-box {
        /* width: 15%; */
        text-align: center;
    }

    .img-crop {
        width: 180px;
        object-fit: cover;
        object-position: center;
        height: 120px;
    }

    .cart-title {
        height: 100%;
    }

    .cart-title h1 {
        padding-top: 5px;
        line-height: 10px;
        font-size: 28px;
        font-weight: 800;
        color: #202020;
    }

    .cart-subtitle {
        line-height: 10px;
        font-size: 18px;
        font-weight: 600;
        color: #909090;
    }

    .counter {
        width: 15%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-counter {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #d9d9d9;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        font-weight: 900;
        color: #202020;
        cursor: pointer;
    }

    .btn-delete {
        width: 40px;
        height: 40px;
        border-radius: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 900;
        cursor: pointer;
        display: none;
    }

    .counter-cart {
        font-size: 20px;
        font-weight: 900;
        color: #202020;
    }

    .prices {
        height: 100%;
        text-align: right;
    }

    .amount {
        padding-top: 20px;
        font-size: 26px;
        font-weight: 800;
        color: #202020;
    }

    .remove {
        padding-top: 5px;
        font-size: 14px;
        font-weight: 600;
        color: #E44C4C;
        cursor: pointer;
    }

    .hr-checkout {
        width: 66%;
        float: right;
        margin-right: 5%;
    }

    .checkout {
        float: right;
        margin-right: 5%;
        width: 50%;
        margin-bottom: 40px;
    }

    .total {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .subtotal {
        font-size: 22px;
        font-weight: 700;
        color: #202020;
    }

    .count-items {
        font-size: 16px;
        font-weight: 500;
        color: #909090;
        line-height: 10px;
    }

    .total-amount {
        font-size: 36px;
        font-weight: 900;
        color: #202020;
    }



    @media screen and (max-width: 768px) {
        .cart-items {
            flex-wrap: wrap;
        }

        .cart-title {
            margin: 10px;
        }

        .cart-items>div {
            flex-basis: 100%;
        }

        .counter {
            justify-content: flex-end;
        }

        .btn-counter {
            margin: 0 10px;
        }

        .img-crop {
            height: 200px;
            width: 100%;
        }

        .checkout {
            width: 100%;
            margin: 0 auto;
        }

        .total-amount {
            font-size: 26px;
        }
    }
</style>
@endsection

@section('header')
<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner"
    style="background-image: url('/gambar/latar.jpg')">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-6.5 text-center">

                <div class="row" style="margin-top: 6em">
                    <div class="login">
                        <div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
                            <h1>Booking</h1>
                            <span class="intro-text-small">Pandan Sari Dive & Watersport</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')

@auth

<div class="cart-not-empty" style="display: none">
    <div class="header-date">
        <h3 class="date"></h3>
        <h5 class="remove-all">Remove All</h5>
    </div>

    @php
    $total = 0;
    @endphp
    @foreach ($carts as $cart)
    @php
    $total += $cart->total;
    @endphp
    <div class="cart-items">
        <div class="image-box">
            <img class="img-thumbnail img-crop" src="{{ Storage::url('water-sport/' . $cart->watersport->image) }}"
                alt="">
        </div>
        <div class="cart-title">
            <h1>{{ $cart->watersport->nama }}</h1>
            <h3 class="cart-subtitle">{{ $cart->tanggal }}</h3>
        </div>
        <div class="counter" data-id="{{ $cart->id }}" data-minimal="{{ $cart->watersport->minimal }}">
            <div class="btn-counter btn-plus">+</div>
            <div class="counter-cart">{{ $cart->jumlah }}</div>
            <div class="btn-counter btn-minus">-</div>
        </div>
        <div class="prices" data-id="{{ $cart->id }}">
            <div class="amount">Rp <span class="amount_rp">{{ number_format($cart->total, 0, ',', '.') }}</span></div>
            <div class="remove"><u>Remove</u></div>
        </div>
    </div>
    @if (!$loop->last)
    <hr>
    @endif
    @endforeach

    <hr class="hr-checkout">
    <div class="checkout">
        <div class="total">
            <div class="subtotal">Sub-Total</div>
            <div class="total-amount">Rp <span class="total-amount_rp"></span></div>
        </div>
        <button class="btn btn-success btn-block">Pembayaran</button>
    </div>
</div>
<div class="cart-empty" style="display: none">
    <h1 class="text-center">Tidak Ada Booking</h1>
</div>
@endauth

@guest
<h1 class="text-center">Silahkan Login Terlebih Dahulu</h1>
@endguest

@endsection

@section('script')
<script>
    const urlChange = `{{ route('change.booking') }}`
    const urlDelete = `{{ route('delete.booking') }}`
    const totalBook = `{{ $carts->count() }}`

    const checkBook = (check) => {
        if (check > 0) {
            $('.cart-not-empty').fadeIn(300)
            $('.cart-empty').fadeOut(300)
        } else {
            $('.cart-not-empty').fadeOut(300)
            $('.cart-empty').fadeIn(300)
        }
    }

    checkBook(totalBook)

    const checkMinus = () => {
        $('.counter-cart').each(function() {
            const parent = $(this).parent()
            const minimal = parseInt(parent.data('minimal'))
            let counterCart = parseInt($(this).text())
            if(counterCart <= minimal){
                parent.find('.btn-minus').css('cursor', 'not-allowed')
            } else {
                parent.find('.btn-minus').css('cursor', 'pointer')
            }
        })
    }

    const totalAmount = () => {
        let total = 0
        $('.amount_rp').each(function(){
            const amount = parseInt($(this).text().split('.').join(''))
            total += amount
        })
        $('.total-amount_rp').text(toRupiah(total))
    }

    totalAmount()

    checkMinus()

    const counter = (pr, count) => {
        const parent = pr.parent()
        const idCart = parent.data('id')
        let counterCart = parseInt(parent.find('.counter-cart').text())
        Swal.fire({
            title: 'Loading',
            timer: 20000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                Swal.stopTimer()
                $.ajax({
                    url: urlChange,
                    method: 'POST',
                    data: {
                        id: idCart,
                        jumlah: count,
                    },
                    complete: () => {
                        Swal.close()
                    },
                    success: (res) => {
                        // console.log(res)
                        counterCart += count;
                        parent.find('.counter-cart').text(counterCart)
                        checkMinus()
                        let total = toRupiah(res.total)
                        parent.closest('.cart-items').find('.amount_rp').text(total)
                        totalAmount()
                    }
                })
            }
        })
    }

    function toRupiah(value) {
        let reverse = value.toString().split('').reverse().join('')
        let val = reverse.match(/\d{1,3}/g)
        val = val.join('.').split('').reverse().join('')
        return val
    }

    $('.btn-plus').click(function(){
        counter($(this), 1)
    })
    $('.btn-minus').click(function(e){
        const cnt = parseInt($(this).parent().find('.counter-cart').text())
        const min = parseInt($(this).parent().data('minimal'))
        if(cnt <= min) {
            e.preventDefault()
        }else{
            counter($(this), -1)
        }
    })
    $('.remove').click(function(e){
        const parent = $(this).parent()
        const idCart = parent.data('id')
        Swal.fire({
            title: 'Loading',
            timer: 20000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                Swal.stopTimer()
                $.ajax({
                    url: urlDelete,
                    method: 'POST',
                    data: {
                        id: idCart,
                    },
                    complete: () => {
                        Swal.close()
                    },
                    success: (res) => {
                        // console.log(res)
                        parent.closest('.cart-items').remove()
                        $('.count-booking').text((res.booking > 0) ? res.booking : '')
                        totalAmount()
                        checkBook(res.booking)
                    }
                })
            }
        })
    })
</script>
@endsection