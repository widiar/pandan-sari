@extends('layout.template')

@section('title')
Home Pandan Sari Dive & Water Sport
@endsection

@section('css')
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        border-radius: 5px;
        margin-top: 20px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total>* {
        margin: 0;
    }

    .total {
        margin-right: auto;
        margin-left: 20px;
    }

    .all_total {
        margin-top: 30px;
        display: flex;
        justify-content: end;
    }

    .col-centered h2 {
        font-size: 40px;
    }

    .btn-read {
        background: #1a1a1a;
        border: 2px solid #1a1a1a !important;
    }

    .btn-sm {
        width: min-content;
        padding: 5px 12px;
    }

    .link {
        margin-bottom: 20px;
    }

    .img-crop {
        object-fit: cover;
        object-position: center;
        height: 100px;
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
                            <h1>Transaksi</h1>
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

@foreach ($invoices as $data)
<div class="card">
    <div class="card-body isi-inv">
        <div class="title">
            <h3>{{ strtoupper($data->nomor) }}</h3>
            <h4>{{ date('d F Y', strtotime($data->created_at)) }}</h4>
            @if ($data->status == 'payment-unverifed')
            <h4 class="badge warning">Processing</h4>
            @elseif ($data->status == 'payment-rejected')
            <h4 class="badge danger">Rejected</h4>
            @else
            <h4 class="badge success">Successfully</h4>
            @endif
        </div>
        <div class="aksi">
            <button class="btn btn-sm btn-primary btn-detail" data-id="{{ $data->id }}">
                <i class="fas fa-eye"></i>
            </button>
            @if ($data->status == 'payment-verifed')
            <a href="{{ route('mail.invoice', ['nomor'=>$data->nomor]) }}" target="_blank">
                <button class="btn btn-sm btn-success">
                    <i class="fas fa-file-invoice-dollar"></i>
                </button>
            </a>
            @elseif ($data->status == 'payment-rejected')
            <button class="btn btn-sm btn-warning upload-bukti" data-total="{{ $data->total }}"
                data-nomor="{{ $data->nomor }}" data-id="{{ $data->id }}">
                <i class="fas fa-upload"></i>
            </button>
            @endif
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="detailModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Detail Booking</h3>
            </div>
            <div class="modal-body isiandetail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transaksiModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Pembayaran</h3>
            </div>
            <form action="{{ route('upload.ulang') }}" method="POST" id="form-pembayaran" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Silahkan Transfer ke Bank BCA</h3>
                    <h3 class="text-center">Total Rp <span class="bayar"></span></h3>
                    <div class="bank-container">
                        <div class="bank-img">
                            <img src="https://www.freepnglogos.com/uploads/logo-bca-png/bank-central-asia-logo-bank-central-asia-bca-format-cdr-png-gudril-1.png"
                                alt="">
                        </div>
                        <div class="bank-text">
                            <h3>a.n. Edward Larry Page</h3>
                            <h4>5138494651354</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bukti">Upload Bukti Pembayaran</label>
                        <div class="custom-file">
                            <input type="file" required name="bukti"
                                class="file custom-file-input @error('bukti') is-invalid @enderror" id="bukti"
                                value="{{ old('bukti') }}" accept="image/x-png, image/jpeg">
                            <label class="custom-file-label" for="bukti">
                                <span class="d-inline-block text-truncate w-75">Browse File</span>
                            </label>
                            @error("bukti")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
                    </div>
                    <img src="https://via.placeholder.com/1080x1080.png?text=BuktiBayar" alt=""
                        class="img-thumbnail img-detail">
                    <small>Klik Gambar Untuk Lihat Detail</small>
                    <input type="hidden" name="totalInv" id="totalInv" value="">
                    <input type="hidden" name="inv" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Bukti Bayar</h3>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-thumbnail img-modal-detail" style="width: 100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('about')
@include('layout.about')
@endsection

@section('script')
<script>
    $('.btn-detail').click(function(e){
        const id = $(this).data('id')
        $.ajax({
            url: `{{ route('detail.invoice') }}`,
            method: 'GET',
            data: {
                id: id
            },
            success: (res) => {
                let html = ''
                let imgUrl = `{{  Storage::url('water-sport/#image') }}`
                res.data.forEach((data) => {
                    html += `
                    <div class="card">
                        <div class="card-body">
                            <div class="detail-img">
                                <img class="img-thumbnail img-crop" src="${imgUrl.replace('#image', data.watersport.image)}" alt="">
                            </div>
                            <div class="total">
                                <h4>${data.watersport.nama}</h4>
                                <p>${data.tanggal}</p>
                                <p>Rp. ${toRupiah(parseInt(data.satuan))}</p>
                                <p>x${data.jumlah}</p>
                            </div>
                            <div class="totalAll">
                                <h4>Rp. ${toRupiah(parseInt(data.total))}</h4>
                            </div>
                        </div>
                    </div>
                    `
                })
                html += `
                <div class="all_total">
                    <h3 style="margin: 0px">Total: Rp ${toRupiah(parseInt(res.total))}</h3>
                </div>
                `
                $('.isiandetail').html(html)
                $('#detailModal').modal('show')
            }
        })
    })

    $('.upload-bukti').click(function(){
        const total = $(this).data('total')
        const nomor = $(this).data('nomor')
        $('.bayar').text(toRupiah(total))
        $('input[name="inv"]').val(nomor)
        console.log(nomor)
        $('#transaksiModal').modal('show')
    })

    $('#form-pembayaran').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: (res) => {
                console.log(res)
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Diproses',
                    showConfirmButton: false,
                    timer: 1500
                }).then((res) => {
                    window.location.href = ''
                })
            },
            error: (res) => {
                Swal.fire("Oops", "Something Wrong!", "error");
                console.log(res.responseJSON)
            }
        })
    })

    $('#bukti').change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".img-detail").attr("src", url)
    })

    $('.img-detail').click(function(){
        $('.img-modal-detail').attr('src', $(this).attr('src'))
        $('#imageModal').modal('show')
    })
</script>
@endsection