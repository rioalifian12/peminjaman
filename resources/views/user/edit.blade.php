@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit User</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="{{ route('user.update', $user->id) }}" class="mb-5">
        @method('put') 
        @csrf
        <div class="mb-3">
            <label for="no_id" class="form-label">No ID</label>
            <input id="no_id" type="text" class="form-control @error('no_id') is-invalid @enderror" name="no_id" autofocus value="{{ old('no_id', $user->no_id) }}">
            @error('no_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="jenis_kelamin" class="mb-2">Gender</label>
          <select name="jenis_kelamin" id="" class="form-select">
              <option {{ old('jenis_kelamin',$user->jenis_kelamin)=="pria"? 'selected':'' }} value="pria">Pria</option>
              <option {{ old('jenis_kelamin',$user->jenis_kelamin)=="wanita"? 'selected':'' }} value="wanita">Wanita</option>
          </select>
      </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input id="no_hp" type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
            @error('no_hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat', $user->alamat) }}">
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
@endsection