@extends('admin.template.admin')

@section('title', 'Gallery')

@section('main-content')
<a href="{{ route('admin.gallery.create') }}" class="m-3">
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
                    <th>Nama</th>
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
                    <td class="text-center">
                        <div class="row justify-content-center" style="min-width: 100px">
                            <a href="{{ Storage::url('gallery/') . $dt->file }}" class="btn-detail">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                            </a>
                            <a href="{{ route('admin.gallery.edit', $dt->id) }}" class="mx-3">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $dt->id) }}" method="POST" class="deleted">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    <td class="text-center">
                        @if($dt->status == 'publish')
                        <h2 class="badge badge-success">Publish</h2>
                        @elseif($dt->status == 'draft')
                        <h2 class="badge badge-warning">Draft</h2>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Gambar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-thumbnail img-detail" style="width: 100%">
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
    $('.btn-detail').click(function(e){
        e.preventDefault()
        const url = $(this).attr('href')
        $('.img-detail').attr('src', url)
        $('#imageModal').modal('show')
    })
</script>
@endsection