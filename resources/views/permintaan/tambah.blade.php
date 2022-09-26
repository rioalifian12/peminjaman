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
        <form method="post" action="/permintaan" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="no_id" class="form-label">No ID</label>
                <input id="no_id" type="text" class="form-control @error('no_id') is-invalid @enderror" name="no_id" required value="{{ old('no_id', auth()->user()->no_id ) }}">
                @error('no_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name_user" class="form-label">Nama User</label>
                <input id="name_user" type="text" class="form-control @error('name_user') is-invalid @enderror" name="name_user" required value="{{ old('name', auth()->user()->name ) }}">
                @error('name_user')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="col-6">
                    <div id="reader" width="600px"></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="name_barang" class="mb-2">Nama Barang</label>
                <input id="name_barang" type="text" class="typeahead form-control @error('name_barang') is-invalid @enderror" name="name_barang" autofocus required value="{{ old('name_barang') }}">
                @error('name_barang')
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
                <h3 class="box-title">Data Barang Tersedia</h3>
            </div>
            <div class="box-body">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Tipe</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                        @if ($item->kondisi == 'baik' && $item->status == 'tersedia')
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tipe }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endif
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"></script>
    <script>
    var path = "{{ route('autocomplete') }}";

    $(document).ready( function () {
        $('#tabel').DataTable();
    });

    $( "#name_barang" ).autocomplete({
        source: function( request, response ) {
        $.ajax({
            url: path,
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