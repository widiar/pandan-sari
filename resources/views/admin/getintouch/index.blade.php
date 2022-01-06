@extends('admin.template.admin')

@section('title', 'Data Get In Touch')

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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subject</th>
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
                    <td>{{ $dt->nama }}</td>
                    <td>{{ $dt->email }}</td>
                    <td>{{ $dt->subject }}</td>
                    <td class="text-center">
                        <div class="row justify-content-center">
                            <button data-text="{{ $dt->pesan }}" class="btn btn-sm btn-primary btn-pesan mx-2"><i class="fas fa-envelope-open
                                "></i></button>
                            <a href="#" class="btn-reply mx-2" data-id="{{ $dt->id }}">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-reply"></i></button>
                            </a>
                            <form action="{{ route('admin.destroy.intouch', $dt->id) }}" method="POST" class="deleted mx-2">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($dt->is_reply == 0)
                        <h3 class="badge badge-warning">Belum Dibalas</h3>
                        @else
                        <h3 class="badge badge-success">Sudah Dibalas</h3>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Pesan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="isiPesan"></p>
            </div>
            <div class="modal-footer btn-bukti-aksi">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="balasPesanModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="pembayaranModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pembayaranModal">Balas Pesan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reply.pesan') }}" method="POST" id="formBalasPesan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Isi Pesan</label>
                        <textarea required name="pesan" class="form-control" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="idContact" id="idContact">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.actionz').on('click', '.btn-pesan', function(e){
        const pesan = $(this).data('text')
        $('.isiPesan').text(pesan)
        $('#pesanModal').modal('show')
    })
    $('.actionz').on('click', '.btn-reply', function(e){
        e.preventDefault()
        $('#idContact').val($(this).data('id'))
        $('#balasPesanModal').modal('show')
    })

    $('#formBalasPesan').submit(function(e){
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