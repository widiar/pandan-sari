@extends('admin.template.admin')

@section('title', 'Data Booking')

@section('css')
<style>
    .card-detail {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        border-radius: 5px;
        margin-top: 20px;
    }

    .card-detail:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .detail-cart {
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .identitas>*,
    .total>* {
        margin: 0;
    }

    .total {
        margin-right: auto;
        margin-left: 20px;
    }

    .img-crop {
        object-fit: cover;
        object-position: center;
        height: 100px;
        width: 100%;
    }

    .all_total {
        margin-top: 30px;
        display: flex;
        justify-content: end;
    }

    @media screen and (max-width: 768px) {
        .detail-img {
            display: none;
        }

        .total {
            margin-left: 0;
        }
    }
</style>
@endsection

@section('main-content')
<a href="{{ route('admin.water-sport.create') }}" class="m-3">
    <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button>
</a>
<div class="card shadow mx-3">
    <div class="card-body table-responsive">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
            {{session('success')}}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
            {{session('error')}}
        </div>
        @endif
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Invoice</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($data))
                @foreach ($data as $dt)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $dt->nomor }}</td>
                    <td class="text-center">
                        <a href="{{ Storage::url('bukti-bayar/' . $dt->bukti_bayar) }}" class="bukti"
                            data-status="{{ $dt->status }}" data-id="{{ $dt->id }}">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </a>
                        <a href="{{ route('detail.invoice') }}" class="detail" data-id="{{ $dt->id }}">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td class="text-center">
                        @if ($dt->status == 'payment-unverifed')
                        <h3 class="badge badge-warning">Payment Unverifed</h3>
                        @elseif ($dt->status == 'payment-rejected')
                        <h3 class="badge badge-danger">Payment Rejected</h3>
                        @else
                        <h3 class="badge badge-success">Payment Verified</h3>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="buktiModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Bukti Bayar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-thumbnail bukti-img" style="width: 100%">
            </div>
            <div class="modal-footer btn-bukti-aksi">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Detail Booking</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="identitas">

                </div>
                <hr>
                <div class="cart">
                    <div class="card-detail">
                        <div class="detail-cart">
                            <div class="detail-img">
                                <img class="img-thumbnail img-crop" src="{{asset('/gambar/parasailing.jpg')}}" alt="">
                            </div>
                            <div class="total">
                                <h4>Paralayang</h4>
                                <p>12/11/2021</p>
                                <p>Rp. 200.000</p>
                                <p>x1</p>
                            </div>
                            <div>
                                <h4>Rp. 200.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all_total">
                    <h3 style="margin: 0px">Total: Rp <span class="totalan">200.000</span></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const formVerif = `{{ route('admin.booking.verif') }}`
    const formReject = `{{ route('admin.booking.reject') }}`

    const formSubmit = (urlForm, id, text) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: urlForm,
                  method: 'POST',
                  data: {
                      id: id
                  },
                  beforeSend: () => {
                    Swal.fire({
                        text: 'Procesiing',
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
                        text: `The data has been ${text}.`,
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
            }
        })
    }

    $(document).on('click', '.bukti', function(e){
        e.preventDefault()
        $('.bukti-img').attr('src', $(this).attr('href'))
        const status = $(this).data('status')
        const id = $(this).data('id')
        let element = ''
        if (status == 'payment-unverifed') {
            element = `
                <form action="${formReject}" method="POST" id="form-reject" data-id="${id}">
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                <form action="${formVerif}" method="POST" id="form-verif" data-id="${id}">
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            `
        } else {
            element = `
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            `
        }
        $('.btn-bukti-aksi').html(element)
        $('#buktiModal').modal('show')
    })

    $(document).on('click', '.detail', function(e){
        e.preventDefault()
        const id = $(this).data('id')
        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            data: {
                id: id
            },
            success: (res) => {
                let htmlCart = ''
                let imgUrl = `{{  Storage::url('water-sport/#image') }}`
                const user = res.user
                const htmlIdentitas = `
                    <h4>${user.nama}</h4>
                    <p>${user.alamat}</p>
                    <p>${user.no_tlp}</p>
                `
                res.data.forEach((data) => {
                    htmlCart += `
                    <div class="card-detail">
                        <div class="detail-cart">
                            <div class="detail-img">
                                <img class="img-thumbnail img-crop" src="${imgUrl.replace('#image', data.watersport.image)}" alt="">
                            </div>
                            <div class="total">
                                <h4>${data.watersport.nama}</h4>
                                <p>${data.tanggal}</p>
                                <p>Rp. ${toRupiah(parseInt(data.satuan))}</p>
                                <p>x${data.jumlah}</p>
                            </div>
                            <div>
                                <h4>Rp. ${toRupiah(parseInt(data.total))}</h4>
                            </div>
                        </div>
                    </div>
                    `
                })
                $('.identitas').html(htmlIdentitas)
                $('.cart').html(htmlCart)
                $('.totalan').text(toRupiah(res.total))
                $('#detailModal').modal('show')
            }
        })
    })

    $(document).on('submit', '#form-reject', function(e){
        e.preventDefault()
        const id = $(this).data('id')
        formSubmit($(this).attr('action'), id, 'rejected')
    })

    $(document).on('submit', '#form-verif', function(e){
        e.preventDefault()
        const id = $(this).data('id')
        formSubmit($(this).attr('action'), id, 'approved')
    })

</script>
@endsection