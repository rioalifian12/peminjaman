@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-0 border-bottom">
  <h1 class="h2">Data Barang</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive px-1">
  <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
  <a href="{{ route ('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
    <form action="{{url("import")}}" method="post" enctype="multipart/form-data" class="mb-3 mt-0">
      @csrf
      <fieldset>
          <label>Upload file excel  <small class="warning text-muted">{{__('Please upload only Excel (.xlsx or .xls) files')}}</small></label>
          <div class="input-group">
              <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">
              @if ($errors->has('uploaded_file'))
                  <p class="text-right mb-0">
                      <small class="danger text-muted" id="file-error">{{ $errors->first('uploaded_file') }}</small>
                  </p>
              @endif
              <div class="input-group-append" id="button-addon2">
                  <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i> Upload</button>
              </div>
          </div>
      </fieldset>
    </form>
  </div>

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
      @if(!empty($datas) && $datas->count())
        @foreach($datas as $data)
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
      @else
        <tr>
          <td colspan="10">There are no data.</td>
        </tr>
      @endif
    </tbody>
  </table>
  {!! $datas->links() !!}
  <div class="pull-right">
    <a href="{{url("export")}}" class="btn btn-primary mb-3 mt-2">Export Excel Data</a>
  </div>
</div>

<script type="text/javascript">
  $(document).ready( function () {
    $('#barangs').DataTable();
  } );
</script>
@endsection