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
        <table id="trTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>Total</th>
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
                    <td>{{ date('j F Y', strtotime($dt->updated_at)) }}</td>
                    <td>{{ $dt->user->nama }}</td>
                    <td>Rp {{ number_format($dt->total, '0', '.', '.') }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    const urlPrint = `{{ route('admin.transaksi.print') }}`
    // const initPrint = () => {
    //     $.ajax({

    //     })
    // }

    $('#trTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-print"></i> Print PDF',
                className: 'btn btn-sm btn-success',
                action: function ( e, dt, node, config ) {
                    window.open(urlPrint, '_blank')
                }
            },         
        ],
    })
</script>
@endsection