@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Akun</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('akun.update', $akun->id) }}" class="mb-5">
        @method('put') 
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $akun->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="mb-2">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $akun->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="mb2">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $akun->password) }}">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="role" class="mb-2">Role</label>
          <select name="role" id="" class="form-select">
              <option {{ old('role',$akun->role)=="user"? 'selected':'' }} value="user">User</option>
              <option {{ old('role',$akun->role)=="admin"? 'selected':'' }} value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
@endsection