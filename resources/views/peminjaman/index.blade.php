@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
  <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
    @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
      <a href="{{ route ('peminjaman.create') }}" class="btn btn-primary ml-1 me-2">Tambah Peminjaman</a>
    @endif
    <a href="{{ $final_url_ngrok }}" class="btn btn-primary ml-1 me-2">Scan Peminjaman</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
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
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
      @foreach ($pinjams as $pinjam)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pinjam->name_user }}</td>
        <td>{{ $pinjam->kode_barang }}</td>
        <td>{{ $pinjam->name_barang }}</td>
        <td>{{ $pinjam->tanggal_pinjam }}</td>
        <td>{{ $pinjam->tanggal_kembali }}</td>
        <td>{{ $pinjam->status }}</td>
        <td>
          @if ($pinjam->status == 'bebas')
              -
          @else
            <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          @endif
        </td>
      </tr>    
      @endforeach
      @elseif (Auth::check())
      
        @foreach ($pinjams as $pinjam)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pinjam->name_user }}</td>
            <td>{{ $pinjam->kode_barang }}</td>
            <td>{{ $pinjam->name_barang }}</td>
            <td>{{ $pinjam->tanggal_pinjam }}</td>
            <td>{{ $pinjam->tanggal_kembali }}</td>
            <td>{{ $pinjam->status }}</td>
            <td></td>
          </tr>    
        @endforeach
      @endif

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