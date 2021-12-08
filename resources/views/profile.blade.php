@extends('layout.template')

@section('title')
Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
    .img-crop {
        object-fit: cover;
        object-position: center;
        width: 100%;
        height: 350px;
    }

    .gtco-cover {
        height: 500px !important
    }

    .error {
        color: red;
    }

    #edit-image:hover {
        cursor: pointer;
    }

    .img-frame {
        position: relative;
    }

    #edit-image {
        position: absolute;
        bottom: 0;
        font-size: 18px;
        background: rgb(71, 71, 71);
        opacity: 0.8;
        width: 100%;
        text-align: center;
        height: 30px;
        color: #fff;
        cursor: pointer;
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
                            <h1>My Profile</h1>
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
<form action="" method="POST" id="profileForm" enctype="multipart/form-data">
    <fieldset>
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="img-frame">
                    @if($data->image)
                    <img src="{{ Storage::url('profile/' . $data->image) }}" alt="" class="img-crop">
                    @else
                    <img src="{{ asset('gambar/profile-placeholder.webp') }}" alt="" class="img-crop">
                    @endif
                    <div id="edit-image"><strong>Edit Image</strong></div>
                </div>
                <input style="display: none;" type="file" name="foto" id="foto" value="{{ old('foto') }}"
                    accept="image/x-png, image/jpeg">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><b>Nama</b></label>
                    <input id="cname" name="nama" type="text" class="form-control" value="{{ $data->nama }}" required>
                </div>
                <div class="form-group">
                    <label for=""><b>Email</b></label>
                    <input id="cemail" name="email" type="email" class="form-control" value="{{ $data->email }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for=""><b>Alamat</b></label>
                    <input id="calamat" name="alamat" type="text" class="form-control" value="{{ $data->alamat }}"
                        required>
                </div>
                <div class="form-group">
                    <label for=""><b>Nomor Telepon</b></label>
                    <input id="cno_tlp" name="no_tlp" type="text" class="form-control" value="{{ $data->no_tlp }}"
                        required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </fieldset>
</form>

@endsection

@section('script')
<script>
    $('#profileForm').validate()

    $("#edit-image").click(function(){
        $("#foto").click()
    })
    $("#foto").change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".img-crop").attr("src", url)
        $('.error-foto').text('')
    })

    $('#profileForm').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
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