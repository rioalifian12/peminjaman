@extends('layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
  </div>

  @if(Auth::check() && Auth::user()->role  == "superadmin")
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card text-bg-info shadow-sm">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="users" class="align-text-bottom text-light mt-3" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-semibold fs-5 text-light mt-3">Data User</div>
          </div>
        </div>
        <a href="/user" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-semibold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card text-bg-secondary shadow-sm">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="user" class="align-text-bottom mt-3" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-semibold fs-5 mt-3">Data Akun</div>
          </div>
        </div>
        <a href="/akun" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-semibold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card text-bg-warning shadow-sm">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="box" class="align-text-bottom mt-3 text-light m-0" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-semibold fs-5 text-light mt-3">Data Barang</div>
          </div>
        </div>
        <a href="/barang" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-semibold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card text-bg-success shadow-sm">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="file-text" class="align-text-bottom mt-3" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-semibold fs-5 mt-3">Data Peminjaman</div>
          </div>
        </div>
        <a href="/peminjaman" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-semibold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  @elseif (Auth::check() && Auth::user()->role  == "admin")
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card text-bg-warning">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="box" class="align-text-bottom mt-3 text-light m-0" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-bold text-light">Data Barang</div>
          </div>
        </div>
        <a href="/barang" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-bold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card text-bg-success">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="file-text" class="align-text-bottom mt-3" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-bold">Data Peminjaman</div>
          </div>
        </div>
        <a href="/peminjaman" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-bold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  @elseif (Auth::check())
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card text-bg-success">
        <div class="card-body">
          <div class="d-flex flex-row align-items-center justify-content-between mb-3">
            <div data-feather="file-text" class="align-text-bottom mt-3" style="width: 3.5rem; height: 3.5rem;"></div>
            <div class="fw-bold">Data Peminjaman</div>
          </div>
        </div>
        <a href="/peminjaman" class="text-decoration-none">
          <div class="card-footer text-bg-light fw-bold">
            <div class="d-flex flex-row align-items-center justify-content-between">
              <div class="fw-bold m-0">View details</div>
              <div data-feather="arrow-right-circle" class="align-text-bottom" style="width: 1.5rem; height: 1.5rem;"></div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  @endif
@endsection
