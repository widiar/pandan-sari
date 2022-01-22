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
                            <h1>Contact Us</h1>
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
        <h2>GET IN TOUCH</h2>
        <p>Tinggalkan pesan pengalamnmu selama bermain wahana di pandan sari dive & water sport</p>
    </div>
</div>
<form action="" method="POST" id="contactForm">
    <fieldset>
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for=""><b>Nama</b></label>
                    <input id="cname" name="nama" type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for=""><b>Email</b></label>
                    <input id="cemail" name="email" type="email" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for=""><b>Subject</b></label>
            <input id="csubject" name="subject" type="text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for=""><b>Pesan</b></label>
            <textarea id="cpesan" name="pesan" rows="10" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </fieldset>
</form>

<hr style="margin-top: 100px">
<div class="text-center">
    <h2>Apa Kata Mereka</h2>
</div>
<hr>
<div class="row">
    @foreach ($contactus as $con)
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3>{{ $con->nama }}</h3>
                <p>{{ $con->pesan }}</p>
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
    $('#contactForm').validate()

    $('#contactForm').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            beforeSend: () => {
            Swal.fire({
                text: 'Procesing',
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading()
                    Swal.stopTimer()
                }
            })
            },
            success: function(res){
                Swal.close()
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = "";
                }) 
            },
            error: (res) => {
            Swal.fire("Oops", "Something Wrong!", "error");
            console.log(res.responseJSON)
            }
        })
    })
</script>
@endsection