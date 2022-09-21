@extends('layouts.main')

@section('container')
    
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <div style="max-height: 400px; overflow:hidden">
          <img src="{{ asset('storage/' . $final_skema_barang['image_final']) }}" alt="{{ $final_skema_barang['image_final'] }}" class="img-fluid">
        </div>
      </div>
      <table class="table table-striped table-sm">
        <tr>
          <td>Kode Barang</td>
          <td>{{ $final_skema_barang['kode_barang_final'] }}</td>
        </tr>
        <tr>
          <td>Nama Barang</td>
          <td>{{ $final_skema_barang['name_final'] }}</td>
        </tr>
        <tr>
          <td>Tipe</td>
          <td>{{ $final_skema_barang['tipe_final'] }}</td>
        </tr>
        <tr>
          <td>Tahun</td>
          <td>{{ $final_skema_barang['tahun_final'] }}</td>
        </tr>
      </table>
    </div> 
  </div>
  @if(Auth::check() && (Auth::user()->role  == "superadmin" || Auth::user()->role  == "admin"))
  <a href="{{ route ('peminjaman.create') }}" class="btn btn-success ml-1 me-2">
    <span data-feather="plus-circle" class="mb-1 me-1"></span>
    Tambah
  </a>
  @endif
@endsection