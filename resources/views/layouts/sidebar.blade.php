<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        @if(Auth::check() && Auth::user()->role  == "superadmin")
        <li class="nav-item">
          <a class="nav-link {{ Request::is('home*') ? 'active' : '' }}" aria-current="page" href="/home">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" aria-current="page" href="/user">
            <span data-feather="users" class="align-text-bottom mt-3"></span>
            User
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('akun*') ? 'active' : '' }}" href="/akun">
            <span data-feather="user" class="align-text-bottom mt-3"></span>
            Akun
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('barang*') ? 'active' : '' }}" href="/barang">
            <span data-feather="box" class="align-text-bottom mt-3"></span>
            Barang
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}" href="/peminjaman">
            <span data-feather="file-text" class="align-text-bottom mt-3"></span>
            Peminjaman
          </a>
        </li>
        @elseif (Auth::check() && Auth::user()->role  == "admin")
        <li class="nav-item">
          <a class="nav-link {{ Request::is('home*') ? 'active' : '' }}" aria-current="page" href="/home">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('barang*') ? 'active' : '' }}" href="/barang">
            <span data-feather="box" class="align-text-bottom mt-3"></span>
            Barang
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}" href="/peminjaman">
            <span data-feather="file-text" class="align-text-bottom mt-3"></span>
            Peminjaman
          </a>
        </li>
        @elseif (Auth::check())
        <li class="nav-item">
          <a class="nav-link {{ Request::is('home*') ? 'active' : '' }}" aria-current="page" href="/home">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('barang*') ? 'active' : '' }}" href="/barang">
            <span data-feather="box" class="align-text-bottom mt-3"></span>
            Barang
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}" href="/peminjaman">
            <span data-feather="file-text" class="align-text-bottom mt-3"></span>
            Peminjaman
          </a>
        </li>
        @endif
      </ul>
    </div>
  </nav>