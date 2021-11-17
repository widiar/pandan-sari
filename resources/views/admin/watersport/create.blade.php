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
        <form action="{{ route('admin.water-sport.store') }}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Water Sport</label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea type="text" required name="description"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" required name="harga" class="form-control  @error('harga') is-invalid @enderror"
                    value="{{ old('harga') }}">
                @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="minimal">Minimal Orang</label>
                <input type="number" required name="minimal"
                    class="form-control  @error('minimal') is-invalid @enderror" value="{{ old('minimal') }}">
                @error('minimal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <div class="img-frame">
                    <img src="https://via.placeholder.com/1080x1080.png?text=Image" alt="" class="img-crop">
                    <div id="edit-image"><strong>Edit Image</strong></div>
                </div>
                <input style="display: none;" type="file" name="foto" id="foto" value="{{ old('foto') }}"
                    accept="image/x-png, image/jpeg">
                @error("foto")
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p class="error-foto text-danger" style="display: none"></p>
                <small id="exampleInputFile" class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            {{-- <div class="form-group">
                <label for="foto">Foto</label>
                <div class="custom-file">
                    <input type="file" required name="foto"
                        class="file custom-file-input @error('foto') is-invalid @enderror" id="foto"
                        value="{{ old('foto') }}" accept="image/x-png, image/jpeg">
                    <label class="custom-file-label" for="foto">
                        <span class="d-inline-block text-truncate w-75">Browse File</span>
                    </label>
                    @error("foto")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small id="exampleInputFile" class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div> --}}
            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
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
        $('.error-foto').text('')
    })

    $('#form').submit(function(e){
        if($('#foto').get(0).files.length == 0){
            e.preventDefault()
            $('.error-foto').text('Foto tidak boleh kosong')
            $('.error-foto').fadeIn();
            return false
        }
    })
</script>
@endsection