@extends('layout.template')

@section('title')
Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
    .img-crop {
        object-fit: cover;
        object-position: center;
        height: 100px;
        width: 100%;
    }

    .gtco-cover {
        height: 500px !important
    }

    .error {
        color: red;
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
                            <h1>Forgot Password</h1>
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
<div class="row">
	<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
		<h2>Forgot Password</h2>
        <p>Masukkan email anda yang sudah terdaftar.</p>
    </div>
</div>
<form action="" method="POST" id="forgotForm">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"
			aria-hidden="true">&times;</button>
		{{session('success')}}
	</div>
	@elseif(session('error'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"
			aria-hidden="true">&times;</button>
		{{session('error')}}
	</div>
	@endif
    <fieldset>
        @csrf
        <div class="form-group">
            <label for=""><b>Email</b></label>
            <input id="csubject" name="email" type="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </fieldset>
</form>

@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
    $('#forgotForm').validate()
</script>
@endsection