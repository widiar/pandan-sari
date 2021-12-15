@extends('admin.template.admin')

@section('title', 'Laporan Transaksi')

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
        <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAdmin">Buat
            Laporan</button>
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>File</th>
                    <th>Bulan</th>
                    <th>Tanggal Pembuatan</th>
                    <th class="text-center">Aksi</th>
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
                    <td class="text-center">
                        <a href="{{ Storage::url('laporan-transaksi/' . $dt->file) }}" target="_blank" class="mx-2">
                            <button class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></button>
                        </a>
                    </td>
                    <td>{{ date('F', mktime(0, 0, 0, $dt->bulan, 10)) }}</td>
                    <td>{{ date('d/m/y h:i A', strtotime($dt->updated_at)) }}</td>
                    <td class="text-center">
                        <div class="row" style="min-width: 100px">
                            <a href="{{ Storage::url('laporan-transaksi/' . $dt->file) }}" class="mx-3 printt">
                                <button class="btn btn-sm btn-warning"><i class="fas fa-print"></i></button>
                            </a>
                            <form action="{{ route('admin.transaksi.delete', $dt->id) }}" method="POST" class="deleted">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<iframe src="#" frameborder="0" id="myFrame"></iframe>
<div class="modal fade" id="modalAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Laporan Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.transaksi.post') }}" method="POST" class="rekap">
                @csrf
                <div class="modal-body form-group">
                    <label for="bulan">Bulan</label>
                    <div class="input-group">
                        <input type="text" id="tgl" name="tanggal" class="form-control datepicker"
                            value="{{ date('m-Y') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.bulan').select2({
            theme: "bootstrap"
        });
        $("#myFrame").hide()
        $(".printt").click(function(e){
            e.preventDefault()
            var url = $(this).attr("href");
            $("#myFrame").attr("src",  url);
            setTimeout(handlePrint, 1000)
        })
    })
    function handlePrint()
    {
        var objFra = document.getElementById('myFrame');
        objFra.contentWindow.focus();
        objFra.contentWindow.print();
    }
    $(".datepicker").datepicker({
        format: 'mm-yyyy',
        todayBtn: "linked",
        startView: "months", 
        minViewMode: "months",
        // daysOfWeekDisabled: "0,6",
        autoclose: true,
        endDate: "+0d",
        todayHighlight: true
    });
    let rekap = $(".rekap");
    $(rekap).submit(function(e){
        e.preventDefault()
        Swal.fire({
            title: 'Laporan Transaksi',
            text: 'Sedang di Proses',
            timer: 1000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                Swal.stopTimer()
                $.ajax({
                    url: $(rekap).attr("action"),
                    method: 'POST',
                    data: $(rekap).serialize(),
                    dataType: 'json',
                    success: function(msg){
                        if (msg == "Success"){
                            Swal.resumeTimer()
                        }else if(msg == "Ada"){
                            Swal.close()
                            Swal.fire("Oops", "Pada Bulan tersebut sudah dibuat", "warning");
                        }
                    },
                    error: (res) => {
                        Swal.close()
                        Swal.fire("Oops", "Something Wrong!", "error");
                        console.log(res.responseJSON)
                    }
                })
            }
        }).then((result) => {
            if(result.dismiss){
                Swal.fire({
                    title: "Success!",
                    text: 'Laporan transaksi berhasil dibuat',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                }).then((res) => {
                    if (res.dismiss) window.location.href = ""
                })
            }
        });
    })
</script>
@endsection