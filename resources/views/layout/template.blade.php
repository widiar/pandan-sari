<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pandan Sari Dive & Water Sport</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords"
		content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

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

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('template')}}/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('template')}}/css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="{{asset('template')}}/css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('template')}}/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('template')}}/css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('template')}}/css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('template')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{asset('template')}}/css/owl.theme.default.min.css">

	<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

	<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('template')}}/css/style.css">

	<!-- Modernizr JS -->
	<script src="{{asset('template')}}/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	@yield('css')

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
				<div class="row row-p	b-md">

					<div class="col-md-4">
						<div class="gtco-widget">
							<h3>About Us</h3>
							<p>“PANDAN SARI Dive and Watersport” teregistrasi dibawah PT PANDAN SARI WISATA TIRTA.
								<br><br>Siap untuk mendampingi pelanggan dalam merencanakan dan mengorganisir Water
								Sport, All Events dalam koordinasi pada kebutuhan pelanggan dan biaya.
							</p>
						</div>
					</div>

					<div class="col-md-2 col-md-push-1">
						<div class="gtco-widget">
							<h3>Water Sport</h3>
							<ul class="gtco-footer-links">
								<li><a href="#">Parasailing</a></li>
								<li><a href="#">Jetski</a></li>
								<li><a href="#">Fly Fish</a></li>
								<li><a href="#">Donut Slider</a></li>
								<li><a href="#">Fly Board</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 col-md-push-1">
						<div class="gtco-widget">
							<h3>Activity</h3>
							<ul class="gtco-footer-links">
								<li><a href="#">Water Ski</a></li>
								<li><a href="#">Wake Board</a></li>
								<li><a href="#">Snorkeling</a></li>
								<li><a href="#">Scuba Diving</a></li>
								<li><a href="#">Sea Walker</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-md-push-1">
						<div class="gtco-widget">
							<h3>Get In Touch</h3>
							<ul class="gtco-quick-contact">
								<li><a href="#"><i class="icon-phone"></i> +62-361 4728126 </a></li>
								<li><a href="#"><i class="icon-phone"></i> +62-819 16404488 </a></li>
								<li><a href="#"><i class="icon-mail2"></i> agustinobsc@yahoo.com</a></li>
								<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
							</ul>
						</div>
					</div>

				</div>

				<div class="row copyright">
					<div class="col-md-12">
						<p class="pull-left">
							<small class="block">&copy; 2021 ITB Stikom Bali Jimbaran.</small>
							<small class="block">Designed by Reva Deandary & Milla Kusuma Dewi
						</p>
						<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
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
	<script src="{{asset('template')}}/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="{{asset('template')}}/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="{{asset('template')}}/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="{{asset('template')}}/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="{{asset('template')}}/js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="{{asset('template')}}/js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="{{asset('template')}}/js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="{{asset('template')}}/js/jquery.magnific-popup.min.js"></script>
	<script src="{{asset('template')}}/js/magnific-popup-options.js"></script>

	<!-- Datepicker -->
	<script src="{{asset('template')}}/js/bootstrap-datepicker.min.js"></script>

	<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

	<!-- Main -->
	<script src="{{asset('template')}}/js/main.js"></script>

	<script>
		toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
        }
	</script>

	@yield('script')

</body>

</html>