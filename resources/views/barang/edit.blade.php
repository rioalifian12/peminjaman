@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Barang</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('barang.update', $data->id) }}" class="mb-5" enctype="multipart/form-data">
        @method('put') 
        @csrf
        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input id="kode_barang" type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" autofocus value="{{ old('kode_barang', $data->kode_barang) }}">
            @error('kode_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tipe" class="mb-2">Tipe</label>
            <input id="tipe" type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" value="{{ old('tipe', $data->tipe) }}">
            @error('tipe')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tahun" class="mb2">Tahun</label>
            <input id="tahun" type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun', $data->tahun) }}">
            @error('tahun')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="" class="form-select">
                <option {{ old('status',$data->status)=="tersedia"? 'selected':'' }} value="tersedia">Tersedia</option>
                <option {{ old('status',$data->status)=="dipinjam"? 'selected':'' }} value="dipinjam">Dipinjam</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kondisi" class="mb-2">Kondisi</label>
            <select name="kondisi" id="" class="form-select">
                <option {{ old('kondisi',$data->kondisi)=="baik"? 'selected':'' }} value="baik">Baik</option>
                <option {{ old('kondisi',$data->kondisi)=="rusak"? 'selected':'' }} value="rusak">Rusak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="hidden" name="oldImage" value="{{ $data->image }}">
            <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->image }}" class="img-preview img-fluid mb-4 col-sm-5 d-block">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
    </form>
</div>
<script type="text/javascript">
    function previewImage()
    {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent)
        {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection