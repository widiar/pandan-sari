@extends('layout.template')

@section('title')
Home Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
	.img-info {
		display: inline;
	}
</style>
@endsection

@section('content')
<div class="info">
	<img class="img-info" src="{{asset('/gambar/parasailing.jpg')}}" alt="">
	<p style="text-align:justify;">Pandan Sari Watwsport adalah</p>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('/picture/parasailing.jpg')}}" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/parasailing.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Parasailing</h2>
				<p>Permainan yang memadukan antara terjun payung dan jetski di Water Sports.</p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('template')}}/images/img_2.jpg" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/latar.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Banana Boat</h2>
				<p>Permainan berbentuk pisang yang akan dinaiki dan di tarik oleh speed boat.</p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('template')}}/images/img_3.jpg" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/parasailing.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Seawalker</h2>
				<p>Aktivitas melihat keindahan pemandangan bawah laut tanpa harus berenang.</p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>


	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('/images/img_4.jpg')}}" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/latar.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Scuba Diving</h2>
				<p>Kegiatan menyelam di bawah permukaan air menggunakan alat bantu pernafasan dengan tabung udara.</p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('/images/img_5.jpg')}}" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/parasailing.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Jet Ski</h2>
				<p>Olahraga air yang dilengkapi dengan jaket pelampung dan ditemani oleh pemandu jetski profesional.</p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-6">
		<a href="{{asset('/images/img_6.jpg')}}" class="fh5co-card-item image-popup">
			<figure>
				<div class="overlay"><i class="ti-plus"></i></div>
				<img src="{{asset('/gambar/latar.jpg')}}" alt="Image" class="img-responsive">
			</figure>
			<div class="fh5co-text">
				<h2>Flying Fish</h2>
				<p>Roket air yang menyediakan daya dorong untuk flyboard di udara menggunakan udara dan air. </p>
				<p><span class="btn btn-primary">Read more</span></p>
			</div>
		</a>
	</div>
</div>
@endsection