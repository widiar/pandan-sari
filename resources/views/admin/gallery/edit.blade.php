@extends('admin.template.admin')

@section('title', 'Edit Gallery')

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
        <form action="{{ route('admin.gallery.update', $data->id) }}" method="post" enctype="multipart/form-data"
            id="form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $data->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option selected disabled>Status</option>
                    <option {{ ($data->status == 'draft') ? 'selected' : '' }} value="draft">Draft</option>
                    <option {{ ($data->status == 'publish') ? 'selected' : '' }} value="publish">Publish</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <div class="img-frame">
                    <img src="{{ Storage::url('gallery/') . $data->file }}" alt="" class="img-crop">
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
            <button type="submit" class="btn btn-block btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#edit-image").click(function(){
        $("#foto").click()
    })
    $("#foto").change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".img-crop").attr("src", url)
        $('.error-foto').text('')
    })

    $('#form').submit(function(e){
        let error = 0
        if($('#status').val() == null){
            error = 1
            $('#status').addClass('is-invalid')
            $('#status').parent().append('<div class="invalid-feedback">This field is required</div>')
        } else {
            $('#status').removeClass('is-invalid')
        }

        if(error == 1){
            e.preventDefault()
            return false
        }
    })
</script>
@endsection