@extends('admin.template.admin')

@section('title', 'Water Sport')

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
                    <th>Nama</th>
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
                    <td>{{ $dt->nama }}</td>
                    <td class="text-center">
                        <div class="row justify-content-center" style="min-width: 100px">
                            <a href="{{ route('admin.water-sport.edit', $dt->id) }}" class="mx-3">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('admin.water-sport.destroy', $dt->id) }}" method="POST"
                                class="deleted">
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

@endsection

@section('script')
<script>
</script>
@endsection