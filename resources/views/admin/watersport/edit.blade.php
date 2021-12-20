@extends('admin.template.admin')

@section('title', 'Tambah Water Sport')

@section('css')
<style>
    .img-crop {
        height: 500px !important;
        width: 100%;
        object-fit: cover;
        object-position: center;
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

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.water-sport.update', $data->id) }}" method="post" enctype="multipart/form-data"
            id="form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama Water Sport</label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $data->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea type="text" required name="description"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $data->deskripsi) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" required name="harga" class="form-control  @error('harga') is-invalid @enderror"
                    value="{{ old('harga', $data->harga) }}">
                @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="minimal">Minimal Orang</label>
                <input type="number" required name="minimal"
                    class="form-control  @error('minimal') is-invalid @enderror"
                    value="{{ old('minimal', $data->minimal) }}">
                @error('minimal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="limit">Maksimal Tiket per Hari</label>
                <input type="number" required name="limit" class="form-control  @error('limit') is-invalid @enderror"
                    value="{{ old('limit', $data->limit) }}">
                @error('limit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <div class="img-frame">
                    <img src="{{ Storage::url('water-sport/') . $data->image }}" alt="" class="img-crop">
                    <div id="edit-image"><strong>Edit Image</strong></div>
                </div>
                <input style="display: none;" type="file" name="foto" id="foto" value="{{ old('foto', $data->foto) }}"
                    accept="image/x-png, image/jpeg">
                @error("foto")
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <small id="exampleInputFile" class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $('input[name="harga"]').simpleMoneyFormat()
    $("#edit-image").click(function(){
        $("#foto").click()
    })
    $("#foto").change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".img-crop").attr("src", url)
    })
</script>
@endsection