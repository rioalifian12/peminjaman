@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Tambah User</h1>
</div>

<div class="col-lg-7">
    <form method="post" action="/user" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="no_id" class="form-label">No ID</label>
            <input id="no_id" type="text" class="form-control @error('no_id') is-invalid @enderror" name="no_id" autofocus value="{{ old('no_id') }}">
            @error('no_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="mb-2">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- <div class="input-group mb-3">
            <label for="password" class="mb-2">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="{{ old('password') }}">
            <span data-feather="edit"><a style="color:#333;" href="#"></a></span>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <div class="form-group">
            <label for="password" class="mb-2">Password</label>
            <div class="input-group" id="show_hide_password">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" aria-label="password" name="password" autocomplete="new-password" value="{{ old('password') }}">
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
                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
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
            <label for="jenis_kelamin" class="mb-2">Gender</label><br>
            <input type="radio" name="jenis_kelamin" value="pria" required> Pria <br>
            <input type="radio" name="jenis_kelamin" value="wanita" required> Wanita
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input id="no_hp" type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}">
            @error('no_hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="role" class="mb-2">Role</label>
            <select name="role" class="form-select">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                @if(Auth::check() && (Auth::user()->role  == "superadmin"))
                <option value="superadmin">Superadmin</option>
                @endif
            </select>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ old('provinsi') }}">
                @error('provinsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
                <input id="kabupaten" type="text" class="form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" value="{{ old('kabupaten') }}">
                @error('kabupaten')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input id="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan') }}">
                @error('kecamatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" id="submit" class="btn btn-primary mb-5">Simpan</button>
        <input type="hidden">
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

    var prov = "{{ route('autocomplete1') }}";
    var kab = "{{ route('autocomplete2') }}";
    var kec = "{{ route('autocomplete3') }}";
    var des = "{{ route('autocomplete4') }}";
  
    $( "#provinsi" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: prov,
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
           $('#provinsi').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
    });

    $( "#kabupaten" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
        url: kab,
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
        $('#kabupaten').val(ui.item.label);
        console.log(ui.item); 
        return false;
    }
    });

    $( "#kecamatan" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
        url: kec,
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
        $('#kecamatan').val(ui.item.label);
        console.log(ui.item); 
        return false;
    }
    });
</script>
@endsection