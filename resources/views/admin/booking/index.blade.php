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
                    <th>Nama Pembeli</th>
                    <th>Tanggal</th>
                    <th>Detail</th>
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
                    <td>{{ $dt->user->nama }}</td>
                    <td>{{ date('d/m/y h:i A', strtotime($dt->created_at)) }}</td>
                    <td>
                        <ul class="list-group list-group-flush">
                        @foreach ($dt->cart as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->watersport->nama }}
                                <span class="badge badge-secondary">{{ $item->jumlah }}</span>
                                <span class="badge badge-primary">{{ date('d-m-Y', strtotime($item->tanggal)) }}</span>
                            </li> 
                        @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        <div class="row justify-content-center">
                            <a href="{{ route('detail.invoice') }}" class="detail mx-2" data-id="{{ $dt->id }}">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></button>
                            </a>
                            <form action="{{ route('admin.booking.destroy', $dt->id) }}" method="POST" class="deleted mx-2">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                            <form action="{{ route('admin.booking.redeem', $dt->id) }}" method="POST" class="redem mx-2" data-value="{{ $dt->is_redeem }}">
                                @csrf
                                @if($dt->is_redeem == 0)
                                <button class="btn btn-sm btn-success" type="submit"><i
                                        class="fas fa-calendar-check"></i></button>
                                @else
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                    class="fas fa-minus"></i></button>
                                @endif
                            </form>  
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($dt->status == 'payment-unverifed')
                        <h3 class="badge badge-warning">Payment Unverifed</h3>
                        @elseif ($dt->status == 'payment-rejected')
                        <h3 class="badge badge-danger">Payment Rejected</h3>
                        @else
                        <h3 class="badge badge-success">Payment Verified</h3>
                        @endif
                        <br>
                        @if($dt->is_redeem == 1)
                        <h3 class="badge badge-success">Redeemed</h3>
                        @else
                        <h3 class="badge badge-info">Not Redeemed</h3>
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

<div class="modal fade" id="alasanRejectModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Alasan Reject</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.booking.reject.reason') }}" method="POST" id="alasanForm" data-id="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Alasan</label>
                        <textarea name="alasan" id="alasan" cols="30" rows="10" class="form-control"
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
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
    
    $(document).on('submit', '#alasanForm', function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: {
                id: $(this).data('id'),
                alasan: $('#alasan').val()
            },
            success: (res) => {
                formSubmit(formReject, res.id, 'rejected')
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    })

    $(document).on('submit', '#form-reject', function(e){
        e.preventDefault()
        const id = $(this).data('id')
        $('#alasanForm').data('id', id)
        $('#alasanRejectModal').modal('show')
        // formSubmit($(this).attr('action'), id, 'rejected')
    })

    $(document).on('submit', '#form-verif', function(e){
        e.preventDefault()
        const id = $(this).data('id')
        formSubmit($(this).attr('action'), id, 'approved')
    })

    $(document).on('submit', '.redem', function(e){
        e.preventDefault()
        let cekval = $(this).data('value')
        Swal.fire({
            title: 'Are you sure?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: $(this).attr('action'),
                  method: 'POST',
                  data: {
                      value: cekval
                  },
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
                    console.log(res)
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
            }
        })
    })

</script>
@endsection