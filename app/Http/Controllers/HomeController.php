<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\User;
use App\Models\Akun;
use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $akuns = Akun::count();
        $barangs = Barang::count();
        $pinjams = Peminjaman::count();

        $barang = Barang::all();
        return view('home')
            ->with(compact('users'))
            ->with(compact('akuns'))
            ->with(compact('barangs'))
            ->with(compact('pinjams'))
            ->with(compact('barang'));
    }
}
