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

    .gtco-cover {
        height: 500px !important
    }
</style>
@endsection

@section('header')
<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(gambar/latar.jpg)">
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
</div>

@endsection

@section('script')
<script>
</script>
@endsection