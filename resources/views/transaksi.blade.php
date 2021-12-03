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

    .badge-warning {
        background-color: rgb(255, 153, 0);
    }

    .badge-danger {
        background-color: red
    }

    .badge-success {
        background-color: green
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
            @if ($data->status == 'payment-unverifed')
            <h4 class="badge badge-warning">Processing</h4>
            @elseif ($data->status == 'payment-rejected')
            <h4 class="badge badge-danger">Rejected</h4>
            @else
            <h4 class="badge badge-success">Successfully</h4>
            @endif
        </div>
        <div class="aksi">
            <button class="btn btn-sm btn-primary btn-detail" data-id="{{ $data->id }}">
                <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i>
            </button>
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
</script>
@endsection