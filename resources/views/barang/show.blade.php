@extends('layouts.main')

@section('container')
    
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $data->name }}</h1>
        <a href="/barang" class="btn btn-success">
          <span data-feather="arrow-left"></span> Kembali
        </a>
        <div style="max-height: 400px; overflow:hidden">
          <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->image }}" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
@endsection