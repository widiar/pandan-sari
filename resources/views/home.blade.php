@extends('layout.template')

@section('title')
Home Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
	.img-info {
		width: 100%;
	}

	.info {
		height: 100%;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		justify-content: center;
	}

	.col-centered {
		vertical-align: middle;
		text-align: center;
		align-self: center;
	}

	.col-centered h2 {
		font-size: 40px;
	}

	.btn-read {
		background: #1a1a1a;
		border: 2px solid #1a1a1a !important;
	}

	.link {
		margin-bottom: 20px;
	}

	.img-crop {
		object-fit: cover;
		object-position: center;
		height: 250px;
		width: 100%;
	}

	.counter {
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		margin-bottom: 20px;
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

	.checkout {
		float: right;
		margin-right: 5%;
		margin-bottom: 40px;
	}

	@media screen and (max-width: 768px) {
		.img-info {
			display: none;
		}
	}
</style>
@endsection

@section('header')
@include('layout.headerLogin')
@endsection

@section('content')
<div class="info gtco-heading">
	<div class="col-lg-6 col-md-6">
		<img class="img-info img-thumbnail w-50" src="{{asset('/gambar/parasailing.jpg')}}" alt="">
	</div>
	<div class="col-lg-6 col-md-6 col-centered">
		<h2>Pandan Sari Watersport</h2>
		<p>Pandan Sari Dive & Water Sport
			merupakan salah satu objek wisata di
			Bali yang menawarkan berbagai
			aktifitas olahraga air atau water sports
			activity</p>
	</div>
</div>

<div class="row">
	@foreach ($watersport as $data)
	<div class="col-lg-4 col-md-4 col-sm-6">
		<div class="fh5co-card-item">
			<a href="{{ Storage::url('water-sport/' . $data->image) }}" class="image-popup">
				<figure>
					<div class="overlay"><i class="ti-plus"></i></div>
					<img src="{{ Storage::url('water-sport/' . $data->image) }}" alt="Image"
						class="img-responsive img-crop">
				</figure>
				<div class="fh5co-text">
					<h2>{{ $data->nama }}</h2>
					{{-- <p style="margin-bottom: 0">{{ $data->deskripsi }}</p> --}}
					<p style="margin-bottom: 0">Harga Rp <b>{{ number_format($data->harga, '0', '.', '.') }}/pax</b></p>
					<p style="margin-bottom: 0">Minimal {{ $data->minimal }} pax</p>
				</div>
			</a>
			@auth
			@php
			$total = 0;
			$counter = 0;
			$idCart = 0;
			if(count($carts) > 0)
			foreach ($carts as $cart) {
			if($cart->watersport_id == $data->id){
			$total = $cart->total;
			$counter = $cart->jumlah;
			$idCart = $cart->id;
			}
			}
			@endphp
			@endauth
			<div class="counter" data-id="{{ $idCart }}" data-minimal="{{ $data->minimal }}"
				data-disabled="@guest true @endguest">
				<div class="btn-counter btn-minus" style="cursor: @guest not-allowed @endguest">-</div>
				<div class="counter-cart">
					@guest
					Please Login
					@endguest
					@auth
					{{ $counter }}
					@endauth
				</div>
				<div class="btn-counter btn-plus" style="cursor: @guest not-allowed @endguest">+</div>
			</div>
			<span class="amount_rp" style="display: none">
				@guest
				0
				@endguest
				@auth
				{{ number_format($total, 0, ',', '.') }}
				@endauth
			</span>
			<div class="link" style="text-align: center">
				<a href="{{ route('detail', $data->id) }}"><button class="btn btn-primary btn-read">Read
						more</button></a>
			</div>
		</div>
	</div>
	@endforeach
</div>
<div class="checkout">
	<div class="total">
		<div class="subtotal">
			<h3>Sub-Total</h3>
		</div>
		<div class="total-amount">
			<h3>Rp <span class="total-amount_rp"></span></h3>
		</div>
	</div>
	@guest
	<button class="btn btn-danger js-gotop">Login</button>
	@endguest
	@auth
	<button class="btn btn-success" data-toggle="modal" data-target="#bayarModal">Pembayaran</button>
	@endauth
</div>
@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
	const urlChange = `{{ route('change.booking') }}`
	const urlDelete = `{{ route('delete.booking') }}`
	const urlAdd = `{{ route('add.booking') }}`
	const checkMinus = () => {
        $('.counter-cart').each(function() {
            const parent = $(this).parent()
            let counterCart = parseInt($(this).text())
            if(counterCart <= 0){
                parent.find('.btn-minus').css('cursor', 'not-allowed')
            } else {
                parent.find('.btn-minus').css('cursor', 'pointer')
            }
        })
    }

	const totalAmount = () => {
        let total = 0
        $('.amount_rp').each(function(){
            const amount = parseInt($(this).text().split('.').join('').trim())
            total += amount
        })
        $('.total-amount_rp').text(toRupiah(total))
        $('.bayar').text(toRupiah(total))
        $('#totalInv').val(total)
    }

	const counter = (pr, count) => {
        const parent = pr.parent()
        const idCart = parent.data('id')
        let counterCart = parseInt(parent.find('.counter-cart').text().trim())
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
                        parent.closest('.fh5co-card-item').find('.amount_rp').text(total)
                        totalAmount()
                    }
                })
            }
        })
    }

	const deleteCart = (pr) => {
		const parent = pr.parent()
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
						parent.find('.counter-cart').text(0)
                        totalAmount()
                    }
                })
            }
        })
	}

	$(document).ready(function() {
		$('#form-signup').submit(function(e){
			const pw1 = $('#pw1').val()
			const pw2 = $('#pw2').val()
			const form = $('#form-signup')
			if(pw1 !== pw2) {
				e.preventDefault()
				toastr.info('Password tidak sama!', 'Password')
				return false;
			}
			if($(this).attr('validated') == 'false'){
				e.preventDefault()
				$.ajax({
					url: `{{ route('check.email') }}`,
					method: 'POST',
					data: {
						email: $('#regEmail').val()
					},
					success: (res) => {
						$('#form-signup').attr('validated', 'true')
						$('#form-signup').submit()
						return true
					},
					error: (res) => {
						console.log(res)
						e.preventDefault()
						toastr.info('Email Sudah terdaftar!', 'Email')
						return false;
					}
				})
			}
		})

		totalAmount()
		checkMinus()
		$('.btn-plus').click(function(e){
			const cekLogin = $(this).parent().data('disabled')
			if(cekLogin.trim() == 'true'){
				e.preventDefault()
			} else {
				const cnt = parseInt($(this).parent().find('.counter-cart').text().trim())
				if (cnt <= 0){

				}
				else{ 
					counter($(this), 1)
				}
			}
		})
		$('.btn-minus').click(function(e){
			const cekLogin = $(this).parent().data('disabled')
			if(cekLogin.trim() == 'true'){
				e.preventDefault()
			} else {
				const cnt = parseInt($(this).parent().find('.counter-cart').text().trim())
				const min = parseInt($(this).parent().data('minimal'))
				if(cnt <= 0) {
					e.preventDefault()
				}
				else if(cnt <= min) {
					deleteCart($(this))
				}else{
					counter($(this), -1)
				}
			}
		})
	})
</script>
@endsection