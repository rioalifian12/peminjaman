@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Peminjaman</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('permintaan.update', $datas->id) }}" class="mb-5">
        @method('put') 
        @csrf
        <div class="mb-3">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="" class="form-select">
                <option {{ old('status',$datas->status)=="ditolak"? 'selected':'' }} value="ditolak">Ditolak</option>
                <option {{ old('status',$datas->status)=="diterima"? 'selected':'' }} value="diterima">Diterima</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
@endsection