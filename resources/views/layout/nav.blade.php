<!-- <div class="page-inner"> -->

<nav class="navbar">

	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-4 col-xs-12"><br>
					<div id="gtco-logo"><a href="/"><img src="{{asset('/gambar/logo.png')}}" style="float: left;"
								class="logo" alt="" width="50%"></div>
				</div>

				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="{{ request()->is('/') ? 'active' : ''}}"><a href="/">Home</a></li>
						<li class="">
							<a href="{{ route('home') }}#booking" class="smoothScroll" data-home="{{ isset($isHome) ? 1 : 0 }}">Booking</a>
						</li>
						<li class="{{ request()->is('gallery') ? 'active' : ''}}"><a
								href="{{ route('gallery') }}">Gallery</a></li>
						@auth
						<li class="has-dropdown">
							<a href="#">Account</a>
							<ul class="dropdown" style="display: none;">
								<li><a href="{{ route('transaksi') }}">Transaksi</a></li>
								<li><a href="{{ route('akun') }}">My Profile</a></li>
								<li><a href="{{ route('logout') }}">Logout</a></li>
							</ul>
						</li>
						@endauth
						<li class="{{ request()->is('about') ? 'active' : ''}}"><a href="{{ route('about') }}">About
								Us</a></li>
						<li class="{{ request()->is('contact') ? 'active' : ''}}"><a
								href="{{ route('contact') }}">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>