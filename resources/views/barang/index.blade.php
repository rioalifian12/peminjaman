@extends('layouts.main')

@section('container')

{{-- Inline CSS --}}
<style>
  .table-wrapper {
    width: 100%; 
    overflow-y: hidden; 
    overflow-x: hidden;
  }

  .form-input-excel {
    flex: 1;
  }

  .table-wrapper tbody td:nth-child(7) div {
    width: 5rem;
  }

  @media (max-width: 992px) {
    .table-wrapper {
      overflow-x: scroll;
    }
  }

  @media (max-width: 967px) {
    .btn-header-wrapper {
      display: block !important;
    }
  }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-0 border-bottom">
  <h1 class="h2">Data Barang</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive px-1">
  {{-- d-flex justify-content-between align-items-center  --}}
  <div class="d-flex justify-content-between align-items-center mb-3 mt-2 btn-header-wrapper">
    @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
    <a href="{{ route ('barang.create') }}" class="btn btn-primary me-2">
      <span data-feather="plus-circle" class="mb-1 me-1"></span>
      Tambah
    </a>
    <a href="{{url("export")}}" class="btn btn-primary mb-3 mt-3 me-5">
      <span data-feather="printer" class="mb-1 me-1"></span>
      Export
    </a>
    <form action="{{url("import")}}" method="post" enctype="multipart/form-data" class="m-0 mb-3 form-input-excel">
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
    @endif
  </div>

  <div class="p-2 table-wrapper">
    <table class="table table-striped table-sm" id="barangs">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Kode Barang</th>
          <th scope="col">Nama</th>
          <th scope="col">Tipe</th>
          <th scope="col">Tahun</th>
          <th scope="col">Jumlah</th>
          @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
          <th scope="col">Barcode</th>
          <th scope="col">Aksi</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @if(!empty($datas) && $datas->count())
        <?php $baseUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'; ?>
          @foreach($datas as $data)
          <?php $url_scan = $baseUrl.'scan/peminjaman_by_kode_barang/'. $data->kode_barang ?>
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <a href="{{ route('barang.show', $data->id) }}">
                  <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->image }}" style="max-height: 100px; overflow:hidden">
                </a>
              </td>
              <td>{{ $data->kode_barang }}</td>
              <td>{{ $data->name }}</td>
              <td>{{ $data->tipe }}</td>
              <td>{{ $data->tahun }}</td>
              <td>{{ $data->jumlah }}</td>
              @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
              <td><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($url_scan,'QRCODE') }}" style="max-height: 100px; overflow:hidden" /></td>
              <td>
                <a href="{{ route('barang.edit', $data->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
                <form action="{{ route('barang.destroy', $data->id) }}" method="POST" class="d-inline">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
              </form>
              </td>
              @endif
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="10">There are no data.</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
  {!! $datas->links() !!}
</div>

<script type="text/javascript">
  $(document).ready( function () {
    $('#barangs').DataTable();
  } );
</script>
@endsection