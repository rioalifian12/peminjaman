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
  <h1 class="h2">Data Peminjaman</h1>
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
    @if(Auth::check() && (Auth::user()->role  == "superadmin"))
      <a href="{{ route ('peminjaman.create') }}" class="btn btn-primary ml-1 me-2">
        <span data-feather="plus-circle" class="mb-1 me-1"></span>
        Tambah
      </a>
    @endif
      <a href="{{ $final_url_ngrok }}" class="btn btn-primary mb-3 mt-3 me-5">
        <span data-feather="camera" class="mb-1 me-1"></span>
        Scan
      </a>
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center form-input-date">
      <div class="btn-toolbar">
        <div class="btn-group me-2">
          <input type="text" name="dates" class="btn btn-outline-success" />
          {{-- @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
          <button type="button" class="btn btn-sm btn-success">Export</button>
          @endif --}}
        </div>
      </div>
    </div>
  </div>
  <table class="table table-striped table-sm" id="peminjamen">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama User</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Tanggal Pinjam</th>
        <th scope="col">Tanggal Kembali</th>
        <th scope="col">Status</th>
        @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
        <th scope="col">Aksi</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($pinjams as $pinjam)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pinjam->name_user }}</td>
        <td>{{ $pinjam->kode_barang }}</td>
        <td>{{ $pinjam->name_barang }}</td>
        <td>{{ $pinjam->tanggal_pinjam }}</td>
        <td>{{ $pinjam->tanggal_kembali }}</td>
        <td>{{ $pinjam->status }}</td>
        @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
        <td>
          @if ($pinjam->status == 'bebas')
              -
          @else
            <a href="{{ route('peminjaman.edit', $pinjam->kode_barang) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          @endif
          <a href="{{ route('report', $pinjam->id) }}" class="badge bg-success" target="_blank"><span data-feather="printer" class="align-text-bottom"></span></a>
          {{-- <a href="{{ route('report', $pinjam->id) }}" class="badge bg-success"><span data-feather="printer" class="align-text-bottom"></span></a> --}}
        </td>
        @endif
      </tr>    
      @endforeach
    </tbody>
  </table>
</div>

<input type="hidden" id="final_new_start_date" value="{{ $final_new_start_date }}">
<input type="hidden" id="final_new_end_date" value="{{ $final_new_end_date }}">

<script type="text/javascript">
  var new_start_date = $('#final_new_start_date').val();
  var new_end_date = $('#final_new_end_date').val();

  $(document).ready( function () {
    $('#peminjamen').DataTable();

    $('input[name="dates"]').daterangepicker({
      startDate: new_start_date,
      endDate: new_end_date,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });

    $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
      console.log('Data Report Range : ', picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      new_start_date = picker.startDate.format('YYYY-MM-DD');
      new_end_date = picker.endDate.format('YYYY-MM-DD');

      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      
      setSessionReport()
    });
  } );

  function setSessionReport() {
    $.ajax({
      url:'http://192.168.18.134:8000/report/date_report_session',
      method:'post',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      data: {
        name_user:'Naca', 
        new_start_date: new_start_date,
        new_end_date: new_end_date,
        _token: @json(csrf_token())
      },
      success:function(res){
        if (res.success == 200) {
          location.reload();
        } else {
          alert('Gagal melakukan sorting data!');
        }

        // console.log('DATA SUKSES SET SESSION : ', res);
      }
    });
  }
</script>
@endsection