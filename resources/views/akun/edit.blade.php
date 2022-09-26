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
            <label for="email" class="mb-2">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $akun->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="mb-2">Password</label>
            <div class="input-group" id="show_hide_password">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" aria-label="password" name="password" autocomplete="new-password" value="{{ old('password', $akun->password) }}">
                <div class="input-group-addon">
                    <span class="input-group-text"><a href="" style="color:#333;"><span data-feather="eye" class="fa fa-eye-slash" aria-hidden="true"></span></a></span>
                </div>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="confirm_password" class="mb-2 mt-3">Confirm Password</label>
            <div class="input-group" id="show_hide_password">
                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password" value="{{ old('password', $akun->password) }}">
                <div class="input-group-addon">
                    <span class="input-group-text"><a href="" style="color:#333;"><span data-feather="eye" class="fa fa-eye-slash" aria-hidden="true"></span></a></span>
                </div>
                @error('confirm_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
             @enderror
            </div>
        </div>
        <div class="mb-3 mt-3">
          <label for="role" class="mb-2">Role</label>
          <select name="role" id="" class="form-select">
              <option {{ old('role',$akun->role)=="user"? 'selected':'' }} value="user">User</option>
              <option {{ old('role',$akun->role)=="admin"? 'selected':'' }} value="admin">Admin</option>
              <option {{ old('role',$akun->role)=="superadmin"? 'selected':'' }} value="superadmin">Superadmin</option>
          </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="is_active" class="mb-2">Status</label>
            <select name="is_active" id="" class="form-select">
                <option {{ old('is_active',$akun->is_active)=="aktif"? 'selected':'' }} value="aktif">Aktif</option>
                <option {{ old('is_active',$akun->is_active)=="tidak"? 'selected':'' }} value="tidak">Tidak</option>
            </select>
          </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>
<script type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });

    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'confirm_password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "confirm_password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });

	var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endsection