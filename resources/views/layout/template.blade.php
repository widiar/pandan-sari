<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pandan Sari Dive & Water Sport</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Pandan Sari" />
	<meta name="keywords" content="pandan sari, dive, bali" />
	<meta name="author" content="Ari Widiarsana" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Favicons -->
	<link href="{{ asset('gambar/logo.png') }}" rel="icon">
	<link href="{{ asset('gambar/logo.png') }}" rel="apple-touch-icon">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('template/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('template/css/icomoon.css')}}">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="{{asset('template/css/themify-icons.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('template/css/bootstrap.css')}}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.min.css')}}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">

	<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

	<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">


	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('template/css/style.css')}}">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

	<!-- Modernizr JS -->
	<script src="{{asset('template/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	@yield('css')

	<style>
		.row-new {
			display: flex;
		}

		.gtco-widget .row-new {
			justify-content: space-between;
		}


		.gtco-row {
			margin-left: 80px;
		}

		.last-row {
			margin-left: 60px
		}

		@media screen and (max-width: 900px) {
			.row-c {
				flex-direction: column;
			}

			.gtco-widget .row-new {
				justify-content: start;
			}

			.isi-row {
				margin-left: 15px;
			}

			.row-new .link:last-child {
				margin-left: 25px;
			}
		}
	</style>

</head>

<body>
	<div class="gtco-loader"></div>
	<div id="page">

		@include('layout.nav')

		@yield('header')

		<div class="gtco-section">
			<div class="gtco-container">
				@yield('content')
			</div>
		</div>

		@yield('about')

		<!-- footer -->
		<footer id="gtco-footer" role="contentinfo">
			<div class="gtco-container">
				<div class="row-new row-c">

					<div class="col-md-4 isi-row">
						<div class="gtco-widget">
							<h3>About Us</h3>
							<p>“PANDAN SARI Dive and Watersport” teregistrasi dibawah PT PANDAN SARI WISATA TIRTA.
								<br><br>Siap untuk mendampingi pelanggan dalam merencanakan dan mengorganisir Water
								Sport, All Events dalam koordinasi pada kebutuhan pelanggan dan biaya.
							</p>
						</div>
					</div>

					<div class="isi-row gtco-row">
						<div class="gtco-widget">
							<h3>Water Sport Activity</h3>
							<div class="row-new">
								<div class="link">
									<ul class="gtco-footer-links">
										@foreach(getWaterSport(0, 6) as $ws)
										<li><a href="{{ route('detail', $ws->id) }}">{{ $ws->nama }}</a></li>
										@endforeach
									</ul>
								</div>
								<div class="link">
									<ul class="gtco-footer-links">
										@foreach(getWaterSport(6, 10) as $ws)
										<li><a href="{{ route('detail', $ws->id) }}">{{ $ws->nama }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="isi-row last-row gtco-row">
						<div class="gtco-widget">
							<h3>Get In Touch</h3>
							<ul class="gtco-quick-contact">
								<li><a href="https://wa.me/6281916404488"><i class="icon-phone"></i> +62 8191 6404 488
									</a></li>
								<li><a href="https://wa.me/6282144339944"><i class="icon-phone"></i> +62 8214 4339 944
									</a></li>
								<li><a href="mailto:pandansari.marine@gmail.com"><i class="icon-mail2"></i>
										pandansari.marine@gmail.com</a></li>
								<li><a href="https://g.page/pandan-sari-watersports"><i class="icon-location2"></i> Jl.
										Pratama No. 104 Tanjung Benoa,
										Bali</a></li>
							</ul>
						</div>
					</div>

				</div>

				<div class="row copyright">
					<div class="col-md-12">
						<p class="pull-left">
							<small class="block copy">&copy; 2021 ITB Stikom Bali Jimbaran.</small>
							<small class="block">Designed by Reva Deandary & Milla Kusuma Dewi
						</p>
						<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="https://instagram.com/pandansari.marine" target="_blank"><i
										class="icon-instagram"></i></a></li>
							<li><a href="https://www.facebook.com/pandansari.marine/" target="_blank"><i
										class="icon-facebook"></i></a></li>
						</ul>
						</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- </div> -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- jQuery -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
		integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Bootstrap -->
	<script src="{{asset('template/js/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('template/js/jquery.waypoints.min.js')}}"></script>
	<!-- Carousel -->
	<script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
	<!-- countTo -->
	<script src="{{asset('template/js/jquery.countTo.js')}}"></script>

	<!-- Magnific Popup -->
	<script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('template/js/magnific-popup-options.js')}}"></script>

	<!-- Datepicker -->
	<script src="{{asset('template/js/bootstrap-datepicker.min.js')}}"></script>

	<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

	<!-- Main -->
	<script src="{{asset('template/js/main.js')}}"></script>

	<script>
		toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
        }
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			},
		});
		function toRupiah(value) {
			let reverse = value.toString().split('').reverse().join('')
			let val = reverse.match(/\d{1,3}/g)
			val = val.join('.').split('').reverse().join('')
			return val
		}
		$(document).on('click', '.smoothScroll', function (event) {
			const isHome = $(this).data('home')
			if (isHome == 1){
				event.preventDefault();
				const link = $.attr(this, 'href').substr($.attr(this, 'href').search('#'), $.attr(this, 'href').length)
				$('html, body').animate({
					scrollTop: $(link).offset().top
				}, 500);
			}
		});
	</script>

	@yield('script')

</body>

</html>