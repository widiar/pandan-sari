<!-- <div class="page-inner"> -->

<nav class="navbar">

	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-4 col-xs-12"><br>
					<div id="gtco-logo"><a href="/"><img src="{{asset('/gambar/logo.png')}}" style="float: left;"
								class="logo" alt="" width="150" height="100"></div>
				</div>

				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="{{ request()->is('/') ? 'active' : ''}}"><a href="/">Home</a></li>
						<li class="{{ request()->is('booking') ? 'active' : ''}}"><a href="booking">Booking</a></li>
						<li class="{{ request()->is('gallery') ? 'active' : ''}}"><a href="gallery">Gallery</a></li>
						<li class="has-dropdown">
							<a href="#">Account</a>
							<ul class="dropdown" style="display: none;">
								<li><a href="#">My Profile</a></li>
								<li><a href="#">Logout</a></li>
							</ul>
						</li>
						<li class="{{ request()->is('aboutus') ? 'active' : ''}}"><a href="aboutus">About Us</a></li>
						<li class="{{ request()->is('contact') ? 'active' : ''}}"><a href="contact">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>