@extends('layout.template')

@section('title')
Home Pandan Sari Dive & Water Sport
@endsection

@section('css')

<link href="{{ asset('plugins/gallery/animate.css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/gallery/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/gallery/venobox/venobox.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('plugins/gallery/style.css') }}" rel="stylesheet">

<style>
    .img-fluid {
        max-width: 100%;
        height: auto;
        vertical-align: middle;
        border-style: none;
    }

    .img-crop {
        object-fit: cover;
        object-position: center;
        height: 200px;
        width: 100%;
    }

    .gtco-cover {
        height: 500px !important
    }

    .warning {
        background-color: rgb(255, 153, 0);
    }

    .danger {
        background-color: red
    }

    .success {
        background-color: green
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
        .detail-img {
            display: none;
        }

        .isi-inv {
            flex-direction: column;
            align-items: flex-start;
        }

        .total {
            margin-left: 0;
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
<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner"
    style="background-image: url('/gambar/latar.jpg')">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-6.5 text-center">

                <div class="row" style="margin-top: 6em">
                    <div class="login">
                        <div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
                            <h1>Gallery</h1>
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
<main id="main">

    <!-- ======= Portfolio Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container">

            {{-- <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                        <li data-filter=".filter-coba">Coba</li>
                    </ul>
                </div>
            </div> --}}
            <h1>List Photo</h1>

            <div class="row gallery-container">

                @foreach ($data as $dt)

                <div class="col-lg-4 col-md-6 gallery-item filter-coba">
                    <div class="gallery-wrap">
                        <img src="{{ Storage::url('gallery/') . $dt->file }}" class="img-fluid img-crop img-thumbnail" alt="">
                        <div class="gallery-info">
                            <h4>{{ $dt->nama }}</h4>
                            <div class="gallery-links">
                                <a href="{{ Storage::url('gallery/') . $dt->file }}" data-gall="portfolioGallery"
                                    class="venobox" title="{{ $dt->nama }}"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->

@endsection

@section('script')
<script src="{{ asset('plugins/gallery/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('plugins/gallery/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('plugins/gallery/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('plugins/gallery/main.js') }}"></script>
<script>

</script>
@endsection