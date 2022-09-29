@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Tambah Peminjaman</h1>
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
<div class="row">
    <div class="col-md-6">
        <form method="post" action="/peminjaman" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="no_id" class="form-label">No ID</label>
                <input id="no_id" type="text" class="typeahead form-control @error('no_id') is-invalid @enderror" name="no_id" autofocus required value="{{ old('no_id' ) }}">
                @error('no_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name_user" class="form-label">Nama User</label>
                <input id="name_user" type="text" class="typeahead form-control @error('name_user') is-invalid @enderror" name="name_user" required value="{{ old('name_user' ) }}">
                @error('name_user')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                {{ csrf_field() }}
            </div>
            <div class="mb-3">
                <div class="col-6">
                    <div id="reader" width="600px"></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="kode_barang" class="mb-2">Kode Barang</label>
                <input id="kode_barang" type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" required value="{{ old('kode_barang') }}">
                @error('kode_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name_barang" class="mb-2">Nama Barang</label>
                <input id="name_barang" type="text" class="form-control @error('name_barang') is-invalid @enderror" name="name_barang" required value="{{ old('name_barang') }}">
                @error('name_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                <input id="tanggal_pinjam" type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" required value="{{ old('tanggal_pinjam') }}">
                @error('tanggal_pinjam')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input id="tanggal_kembali" type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" required value="{{ old('tanggal_kembali') }}">
                @error('tanggal_kembali')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5">Simpan</button>
        </form>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Barang</h3>
            </div>
            <div class="box-body">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['kode_barang'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['status'] }}</td>
                            <td>{{ $item['kondisi'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"></script>
    <script>
    var noid = "{{ route('autocomplete11') }}";
    var user = "{{ route('autocomplete12') }}";
    var kode = "{{ route('autocomplete13') }}";
    var barang = "{{ route('autocomplete14') }}";

    $(document).ready( function () {
        $('#tabel').DataTable();
    });
  
    $( "#no_id" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: noid,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#no_id').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
    });

    $( "#name_user" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
        url: user,
        type: 'GET',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            response( data );
        }
        });
    },
    select: function (event, ui) {
        $('#name_user').val(ui.item.label);
        console.log(ui.item); 
        return false;
    }
    });

    $( "#kode_barang" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
        url: kode,
        type: 'GET',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            response( data );
        }
        });
    },
    select: function (event, ui) {
        $('#kode_barang').val(ui.item.label);
        console.log(ui.item); 
        return false;
    }
    });

    $( "#name_barang" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
        url: barang,
        type: 'GET',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            response( data );
        }
        });
    },
    select: function (event, ui) {
        $('#name_barang').val(ui.item.label);
        console.log(ui.item); 
        return false;
    }
    });
  </script>
@endsection