@extends('layout.template')

@section('title')
Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
    .gtco-cover {
        height: 500px !important
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
                            <h1>About Us</h1>
                            <span class="intro-text-small">Pandan Sari Dive & Watersport</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.gtco-section').remove()
        $('.about-us-title').hide()
    })
</script>
@endsection