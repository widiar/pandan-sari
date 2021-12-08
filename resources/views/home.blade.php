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
		<p>Pandan Sari Watersport adalah.....</p>
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
					<p>{{ $data->deskripsi }}</p>
				</div>
			</a>
			<div class="link" style="text-align: center">
				<a href="{{ route('detail', $data->id) }}"><button class="btn btn-primary btn-read">Read
						more</button></a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
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
	})
</script>
@endsection