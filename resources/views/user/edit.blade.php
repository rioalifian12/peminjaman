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
        {{-- <div class="mb-3">
          <label for="jenis_kelamin" class="mb-2">Gender</label>
          <select name="jenis_kelamin" id="" class="form-select">
              <option {{ old('jenis_kelamin',$user->jenis_kelamin)=="pria"? 'selected':'' }} value="pria">Pria</option>
              <option {{ old('jenis_kelamin',$user->jenis_kelamin)=="wanita"? 'selected':'' }} value="wanita">Wanita</option>
          </select>
        </div> --}}
        <div class="mb-3">
            <label for="jenis_kelamin" class="mb-2">Gender</label><br>
            <input type="radio" name="jenis_kelamin" value="pria" required> Pria <br>
            <input type="radio" name="jenis_kelamin" value="wanita" required> Wanita
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
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}">
                @error('provinsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kabupaten" class="form-label">Kabupaten</label>
                <input id="kabupaten" type="text" class="form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" value="{{ old('kabupaten', $user->kabupaten) }}">
                @error('kabupaten')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input id="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan', $user->kecamatan) }}">
                @error('kecamatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
      </form>
</div>

<script type="text/javascript"></script>
<script>
    var prov = "{{ route('autocomplete1') }}";
    var kab = "{{ route('autocomplete2') }}";
    var kec = "{{ route('autocomplete3') }}";
  
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