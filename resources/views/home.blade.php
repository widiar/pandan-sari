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

	.counter-cart input {
		border: none;
		text-align: center;
		outline: none;
		width: 50px;
	}

	.counter-cart input::-webkit-outer-spin-button,
	.counter-cart input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	.counter-cart input {
	-moz-appearance: textfield;
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
		.img-info {
			display: none;
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
					<p style="margin-bottom: 0">Harga Rp <b class="harga_satuan">{{ number_format($data->harga,
							'0', '.', '.') }}</b>/pax</p>
					<p style="margin-bottom: 0">Minimal {{ $data->minimal }} pax</p>
				</div>
			</a>
			<div class="watersport" style="display: none">{{ $data->id }}</div>
			@php
				$idCart = 0;
				$isDisabled = '';
				$cursor = '';
				if($data->getSisa(date('d')) <= 0 || !Auth::check()){ 
					$isDisabled='true' ; 
					$cursor='not-allowed' ;
					$counter='Tiket Habis' ; 
				} 
			@endphp 
			@auth 
				@php 
					$total=0; $counter=0; if(count($carts)> 0)
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
				data-disabled="{{ $isDisabled }}" data-maksimal="{{ $data->getSisa(date('d')) }}">
				<div class="btn-counter btn-minus" style="cursor: {{ $cursor }}">-</div>
				<div class="counter-cart">
					{{-- <input type="number" placeholder="Login"> --}}
					@guest
					Please Login
					@endguest
					@auth
					{{ ($data->getSisa(date('d')) <= 0) ? 'Tiket Habis' : $counter }} @endauth 
				</div>
				<div class="btn-counter btn-plus" style="cursor: {{ $cursor }}">+</div>
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
		<button class="btn btn-success btn-bayar" data-toggle="modal" data-target="#bayarModal">Pembayaran</button>
		@endauth
	</div>
	<div class="modal fade" id="bayarModal" data-backdrop="static" tabindex="-1" role="dialog"
		aria-labelledby="pembayaranModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="pembayaranModal">Detail</h3>
				</div>
				<form action="{{ route('identitas') }}" method="POST" id="form-identitas">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label for="">Tanggal</label>
							<input name="tanggal" id="tanggal" required type="text" class="form-control"
								value="{{ @$carts[0]->tanggal }}">
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input type="text" required class="form-control" name="nama"
								placeholder="Masukkan Nama Lengkap" value="{{ @$user->nama }}">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" required class="form-control" name="alamat" placeholder="Masukkan Alamat"
								value="{{ @$user->alamat }}">
						</div>
						<div class="form-group">
							<label for="tlp">No. Telepon</label>
							<input type="text" required class="form-control" name="tlp"
								placeholder="Masukkan No. Telepon" value="{{ @$user->no_tlp }}">
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
				<form action="{{ route('make.invoice') }}" method="POST" id="form-pembayaran"
					enctype="multipart/form-data">
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
            if(counterCart <= 0 || isNaN(counterCart)){
                parent.find('.btn-minus').css('cursor', 'not-allowed')
            } else {
                parent.find('.btn-minus').css('cursor', 'pointer')
            }
        })
    }
	const checkMaks = () => {
        $('.counter-cart').each(function() {
            const parent = $(this).parent()
			const maksimal = parseInt(parent.data('maksimal'))
            let counterCart = parseInt($(this).text())
            if(counterCart >= maksimal || isNaN(counterCart)){
                parent.find('.btn-plus').css('cursor', 'not-allowed')
            } else {
                parent.find('.btn-plus').css('cursor', 'pointer')
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
		if (total == 0) $('.btn-bayar').attr('disabled', 'disabled')
		else $('.btn-bayar').removeAttr('disabled')
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
						checkMaks()
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
						parent.closest('.fh5co-card-item').find('.amount_rp').text(0)
                        totalAmount()
                    }
                })
            }
        })
	}

	const addCart = (pr) => {
		const parent = pr.parent()
		const minim = parent.data('minimal')
        // const idCart = parent.data('id')
		const satuan = parent.closest('.fh5co-card-item').find('.harga_satuan').text().split('.').join('').trim()
		const idWa = parent.closest('.fh5co-card-item').find('.watersport').text()
        Swal.fire({
            title: 'Loading',
            timer: 20000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                Swal.stopTimer()
                $.ajax({
                    url: urlAdd,
                    method: 'POST',
                    data: {
                        watersport: idWa,
						orang: minim,
						satuan: satuan
                    },
                    complete: () => {
                        Swal.close()
                    },
                    success: (res) => {
                        // console.log(res)
						parent.find('.counter-cart').text(minim)
						parent.data('id', res.cart.id)
						let total = toRupiah(res.total)
                        parent.closest('.fh5co-card-item').find('.amount_rp').text(total)
                        totalAmount()
						checkMinus()
						checkMaks()
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

		$("#tanggal").datepicker({
			minDate: 0,
		});

		totalAmount()
		checkMinus()
		checkMaks()
		$('.btn-plus').click(function(e){
			const cekLogin = $(this).parent().data('disabled')
			if(cekLogin.toString().trim() == 'true'){
				e.preventDefault()
			} else {
				const cnt = parseInt($(this).parent().find('.counter-cart').text().trim())
				const maksimal = parseInt($(this).parent().data('maksimal'))
				if (cnt <= 0){
					addCart($(this))
				}
				else if(cnt >= maksimal) {
					e.preventDefault()
				}
				else{ 
					counter($(this), 1)
				}
			}
		})
		$('.btn-minus').click(function(e){
			const cekLogin = $(this).parent().data('disabled')
			if(cekLogin.toString().trim() == 'true'){
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

		$('#form-identitas').submit(function(e){
			e.preventDefault()
			$.ajax({
				url: $(this).attr('action'),
				method: $(this).attr('method'),
				data: $(this).serialize(),
				success: (res) => {
					if(res.status == 'Success') {
						$('#bayarModal').modal('hide')
						$('#transaksiModal').modal('show')
					} else {
						Swal.fire({
							icon: 'info',
							title: 'Tiket Sudah habis',
							html: `Tiket untuk wahana <b>${res.wisata.join(', ')}</b> pada tanggal <b>${res.tanggal}</b> sudah habis`
							// showConfirmButton: false,
							// timer: 1500
						})
					}
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
	})
	</script>
	@endsection