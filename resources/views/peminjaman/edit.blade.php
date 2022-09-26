@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Peminjaman</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('peminjaman.update', $final_skema_pinjam['id_final']) }}" class="mb-5">
        @method('put') 
        @csrf
        <div class="mb-3">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="" class="form-select">
                <option {{ old('status',$final_skema_pinjam['status_final'])=="bebas"? 'selected':'' }} value="bebas">Bebas</option>
            </select>
        </div>
        <div class="mb-3">
          <label for="kondisi" class="mb-2">Kondisi Barang</label>
          <select name="kondisi" id="" class="form-select">
              <option {{ old('kondisi',$final_skema_barang['kondisi_final'])=="baik"? 'selected':'' }} value="baik">Baik</option>
              <option {{ old('kondisi',$final_skema_barang['kondisi_final'])=="rusak"? 'selected':'' }} value="rusak">Rusak</option>
          </select>
      </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
@endsection