@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Data User</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <a href="{{ route ('user.create') }}" class="btn btn-primary mb-3 mt-2">
    <span data-feather="plus-circle" class="mb-1 me-1"></span>
    Tambah
  </a>
  <table class="table table-striped table-sm" id="users">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">No ID</th>
        <th scope="col">Nama</th>
        <th scope="col">Gender</th>
        <th scope="col">No HP</th>
        <th scope="col">Alamat</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->no_id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->jenis_kelamin }}</td>
        <td>{{ $user->no_hp }}</td>
        <td>{{ $user->alamat }}</td>
        <td>
          <a href="{{ route('user.edit', $user->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
        </form>
        </td>
      </tr>    
      @endforeach
      
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function () {
    $('#users').DataTable();
} );
</script>
@endsection