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
<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner"
    style="background-image: url('/gambar/latar.jpg')">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-6.5 text-center">

                <div class="row" style="margin-top: 6em">
                    <div class="login">
                        <div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
                            <h1>Detail Watersport</h1>
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

<div style="text-align: center; margin-bottom: 25px">
    <img class="img-thumbnail w-50" src="{{ Storage::url('water-sport/' . $data->image) }}" alt="">
</div>
<h1 class="text-center">{{ $data->nama }}</h1>
<h4>{{ $data->deskripsi }}</h4>
<h3>Harga Tiket Rp. {{ $data->harga }}</h3>
<h4>Minimal : {{ $data->minimal }} Orang</h4>

@guest
<hr>
<a href="{{ route('home') }}">
    <button class="text-center btn btn-danger btn-block">Silahkan Login Terlebih Dahulu Untuk Melakukan Booking</button>
</a>
<hr>
@endguest

@auth
<form action="{{ route('add.booking') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Tanggal</label>
        <input name="tanggal" required type="date" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Jumlah Orang</label>
        <input name="orang" required min="{{ $data->minimal }}" type="number" class="form-control orang">
    </div>
    <h3>Total Harga: Rp. <span id="total"></span></h3>
    <input type="hidden" name="total">
    <input type="hidden" name="watersport" value="{{ $data->id }}">
    <input type="hidden" name="satuan" value="{{ $data->harga }}">
    <button type="submit" class="btn btn-primary btn-block">Booking</button>
</form>
@endauth

@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
    let harga = `{{ $data->harga }}`
    $('.orang').keyup(function(){
        const total = $(this).val() * parseInt(harga)
        $('#total').text(total)
        $('input[name="total"]').val(total)
    })

    $('form').submit(function(e){
        e.preventDefault()

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: (res) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Membuat booking',
                    showConfirmButton: false,
                    timer: 1500
                }).then((res) => {
                    window.location.href = ''
                })
            },
            fail: (res) => {
                alert(res)
            }
        })
    })
</script>
@endsection