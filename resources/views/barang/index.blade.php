@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Data Barang</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <a href="{{ route ('barang.create') }}" class="btn btn-primary mb-3 mt-2">Tambah Barang</a>
  <table class="table table-striped table-sm" id="barangs">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama</th>
        <th scope="col">Tipe</th>
        <th scope="col">Tahun</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datas as $data)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->kode_barang }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->tipe }}</td>
        <td>{{ $data->tahun }}</td>
        <td>{{ $data->jumlah }}</td>
        <td>
          <a href="{{ route('barang.edit', $data->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          <form action="{{ route('barang.destroy', $data->id) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
        </form>
        </td>
      </tr>    
      @endforeach
      
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function () {
    $('#barangs').DataTable();
} );
</script>
@endsection