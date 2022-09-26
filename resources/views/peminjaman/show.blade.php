@extends('layouts.main')

@section('container')
    
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <table class="table table-striped table-sm">
          <tr>
            <td>No ID</td>
            <td>{{ $final_skema_pinjam['no_id_final'] }}</td>
          </tr>
          <tr>
            <td>Nama User</td>
            <td>{{ $final_skema_pinjam['name_user_final'] }}</td>
          </tr>
          <tr>
            <td>Kode Barang</td>
            <td>{{ $final_skema_pinjam['kode_barang_final'] }}</td>
          </tr>
          <tr>
            <td>Nama Barang</td>
            <td>{{ $final_skema_pinjam['name_barang_final'] }}</td>
          </tr>
          <tr>
            <td>Tanggal Pinjam</td>
            <td>{{ $final_skema_pinjam['tanggal_pinjam_final'] }}</td>
          </tr>
          <tr>
            <td>Tanggal Kembali</td>
            <td>{{ $final_skema_pinjam['tanggal_kembali_final'] }}</td>
          </tr>
        </table>
        @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
        <a href="{{ route('peminjaman.edit', $final_skema_pinjam['kode_barang_final']) }}" class="btn btn-success">
          <span data-feather="edit"></span> Pengembalian
        </a>
        @endif
        </div>
      </div>
    </div>
  </div>
@endsection