@extends('layouts.main')

@section('container')

{{-- Inline CSS --}}
<style>
  .table-wrapper {
    width: 100%; 
    overflow-y: hidden; 
    overflow-x: hidden;
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
  <h1 class="h2">Data Permintaan</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@elseif (session()->has('error'))
<div class="alert alert-danger" role="alert">
  {{ session('error') }}
</div>
@endif

<div class="table-responsive px-1">
  <div class="d-flex justify-content-between align-items-center mb-3 mt-2 btn-header-wrapper">
    @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "user"))
      <a href="{{ route ('permintaan.create') }}" class="btn btn-primary ml-1 me-2">
        <span data-feather="plus-circle" class="mb-1 me-1"></span>
        Tambah
      </a>
    @endif
  </div>
  <table class="table table-striped table-sm" id="peminjamen">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">No ID</th>
        <th scope="col">Nama User</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Status</th>
        @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
        <th scope="col">Aksi</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($datas as $data)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->no_id }}</td>
        <td>{{ $data->name_user }}</td>
        <td>{{ $data->name_barang }}</td>
        <td>{{ $data->status }}</td>
        @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
        <td>
          @if ($data->status == 'ditolak' || $data->status == 'diterima')
          -
          @else
            <a href="{{ route('permintaan.edit', $data->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          @endif
        </td>
        @endif
      </tr>    
      @endforeach
    </tbody>
  </table>
</div>

<script type="text/javascript">
  var new_start_date = $('#final_new_start_date').val();
  var new_end_date = $('#final_new_end_date').val();

  $(document).ready( function () {
    $('#peminjamen').DataTable();
    });
</script>
@endsection