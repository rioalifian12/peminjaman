@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Data Akun</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <table class="table table-striped table-sm" id="users">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($akuns as $akun)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $akun->name }}</td>
        <td>{{ $akun->email }}</td>
        <td>{{ $akun->password }}</td>
        <td>{{ $akun->role }}</td>
        <td>
          <a href="{{ route('akun.edit', $akun->id) }}" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
          <form action="{{ route('akun.destroy', $akun->id) }}" method="POST" class="d-inline">
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