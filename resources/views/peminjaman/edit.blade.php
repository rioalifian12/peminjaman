@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Peminjaman</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('peminjaman.update', $pinjams->id) }}" class="mb-5">
        @method('put') 
        @csrf
        
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input id="tanggal_kembali" type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ old('tanggal_kembali', $pinjams->tanggal_kembali) }}">
            @error('tanggal_kembali')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="" class="form-select">
                <option {{ old('status',$pinjams->status)=="bebas"? 'selected':'' }} value="bebas">Bebas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
@endsection