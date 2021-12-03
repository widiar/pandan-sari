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

    .bank-container {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .bank-img img {
        object-fit: contain;
        object-position: center;
        width: 200px;
    }

    .img-detail {
        object-fit: cover;
        object-position: center;
        width: 100%;
        cursor: pointer;
        height: 200px;
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

        .bank-img {
            margin: 0 20px;
        }

        .bank-img img {
            width: 100px;
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
        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#bayarModal">Pembayaran</button>
    </div>
</div>
<div class="cart-empty" style="display: none">
    <h1 class="text-center">Tidak Ada Booking</h1>
</div>
<input type="hidden" class="totalBook" value="{{ $carts->count() }}">
@endauth

@guest
<h1 class="text-center">Silahkan Login Terlebih Dahulu</h1>
<input type="hidden" class="totalBook" value="0">
@endguest

<div class="modal fade" id="bayarModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Identitas</h3>
            </div>
            <form action="{{ route('identitas') }}" method="POST" id="form-identitas">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" required class="form-control" name="nama" placeholder="Masukkan Nama Lengkap"
                            value="{{ @$user->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" required class="form-control" name="alamat" placeholder="Masukkan Alamat"
                            value="{{ @$user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="tlp">No. Telepon</label>
                        <input type="text" required class="form-control" name="tlp" placeholder="Masukkan No. Telepon"
                            value="{{ @$user->no_tlp }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="transaksiModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Pembayaran</h3>
            </div>
            <form action="{{ route('make.invoice') }}" method="POST" id="form-pembayaran" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Silahkan Transfer ke Bank BCA</h3>
                    <h3 class="text-center">Total Rp <span class="bayar"></span></h3>
                    <div class="bank-container">
                        <div class="bank-img">
                            <img src="https://www.freepnglogos.com/uploads/logo-bca-png/bank-central-asia-logo-bank-central-asia-bca-format-cdr-png-gudril-1.png"
                                alt="">
                        </div>
                        <div class="bank-text">
                            <h3>a.n. Edward Larry Page</h3>
                            <h4>5138494651354</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bukti">Upload Bukti Pembayaran</label>
                        <div class="custom-file">
                            <input type="file" required name="bukti"
                                class="file custom-file-input @error('bukti') is-invalid @enderror" id="bukti"
                                value="{{ old('bukti') }}" accept="image/x-png, image/jpeg">
                            <label class="custom-file-label" for="bukti">
                                <span class="d-inline-block text-truncate w-75">Browse File</span>
                            </label>
                            @error("bukti")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
                    </div>
                    <img src="https://via.placeholder.com/1080x1080.png?text=BuktiBayar" alt=""
                        class="img-thumbnail img-detail">
                    <small>Klik Gambar Untuk Lihat Detail</small>
                    <input type="hidden" name="totalInv" id="totalInv" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Bukti Bayar</h3>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-thumbnail img-modal-detail" style="width: 100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const urlChange = `{{ route('change.booking') }}`
    const urlDelete = `{{ route('delete.booking') }}`
    const urlDeletAll = `{{ route('delete.all.booking') }}`
    const totalBook = $('.totalBook').val()

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
        $('.bayar').text(toRupiah(total))
        $('#totalInv').val(total)
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
    $('.remove-all').click(function(e){
        Swal.fire({
            title: 'Loading',
            timer: 20000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                Swal.stopTimer()
                $.ajax({
                    url: urlDeletAll,
                    method: 'POST',
                    complete: () => {
                        Swal.close()
                    },
                    success: (res) => {
                        // console.log(res)
                        $('.count-booking').text((res.booking > 0) ? res.booking : '')
                        totalAmount()
                        checkBook(res.booking)
                    }
                })
            }
        })
    })

    $('#form-identitas').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: (res) => {
                $('#bayarModal').modal('hide')
                $('#transaksiModal').modal('show')
            }
        })
    })
    
    $('#form-pembayaran').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: (res) => {
                console.log(res)
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Diproses',
                    showConfirmButton: false,
                    timer: 1500
                }).then((res) => {
                    window.location.href = ''
                })
            }
        })
    })

    $('#bukti').change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".img-detail").attr("src", url)
    })

    $('.img-detail').click(function(){
        $('.img-modal-detail').attr('src', $(this).attr('src'))
        $('#imageModal').modal('show')
    })

    $('body').on('hidden.bs.modal', function () {
        if($('.modal.in').length > 0)
        {
            $('body').addClass('modal-open');
        }
    });
</script>
@endsection