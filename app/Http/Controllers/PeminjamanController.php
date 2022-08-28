<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class PeminjamanController extends Controller
{
    public function show_report_session()
    {
        $final_name_user = Session::get('name_user');

        return response()->json(['success'=>$final_name_user]);
    }

    public function date_report_session(Request $request)
    {
        // $new_start_date = $request->input('new_start_date');
        // $new_end_date = $request->input('new_end_date'); 

        // Session::put('new_start_date', $new_start_date);
        // Session::put('new_end_date', $new_end_date);


        $name_user = $request->input('name_user');
        $new_start_date = $request->input('new_start_date');
        $new_end_date = $request->input('new_end_date');

        Session::put('name_user', $name_user);
        Session::put('new_start_date', $new_start_date);
        Session::put('new_end_date', $new_end_date);

        $final_name_user = Session::get('name_user');
        $final_new_start_date = Session::get('new_start_date');
        $final_new_end_date = Session::get('new_end_date');

        return response()->json([
            'success' => 200,
            'final_name_user' => $final_name_user,
            'final_new_start_date' => $final_new_start_date,
            'final_new_end_date' => $final_new_end_date
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session_name_user = '';
        $session_new_start_date = date("Y-m-d");
        $session_new_end_date = date("Y-m-d");

        if (Session::get('name_user')) $session_name_user = Session::get('name_user');
        if (Session::get('new_start_date')) $session_new_start_date = Session::get('new_start_date');
        if (Session::get('new_end_date')) $session_new_end_date = Session::get('new_end_date');

        $final_name_user = $session_name_user;
        $final_new_start_date = $session_new_start_date;
        $final_new_end_date = $session_new_end_date;

        // echo "<pre>";
        // print_r($final_name_user);
        // print_r($final_new_start_date);
        // print_r($final_new_end_date);
        // exit();

        // [id] => 10
        //     [no_id] => U1000
        //     [name] => Rio Alifian Santoso
        //     [email] => rioalifian12@gmail.com
        // [role] => user
        $final_auth_user = \Auth::user();
        $auth_id = $final_auth_user->id;
        $auth_no_id = $final_auth_user->no_id;
        $auth_name = $final_auth_user->name;
        $auth_email = $final_auth_user->email;
        $auth_role = $final_auth_user->role;
        $final_auth = array(
            'auth_id' => $auth_id,
            'auth_no_id' => $auth_no_id,
            'auth_name' => $auth_name,
            'auth_email' => $auth_email,
            'auth_role' => $auth_role
        );


        $new_start_date = '2022-08-28';
        $new_end_date = '2022-08-29';
        $new_start_date = $final_new_start_date;
        $new_end_date = $final_new_end_date;


        if($auth_role  == "superadmin" || $auth_role == "admin") {
            // $pinjams = Peminjaman::all();
            $pinjams = DB::table('peminjamen')
            ->where(function($query) use ($new_start_date, $new_end_date){
                $query->whereBetween('tanggal_pinjam', [$new_start_date,$new_end_date])
                      ->orWhereBetween('tanggal_kembali', [$new_start_date,$new_end_date]);
                })
            ->get();
        } else {
             $pinjams = DB::table('peminjamen')
                ->where('no_id', '=', $auth_no_id)
                ->where(function($query) use ($new_start_date, $new_end_date){
                    $query->whereBetween('tanggal_pinjam', [$new_start_date,$new_end_date])
                          ->orWhereBetween('tanggal_kembali', [$new_start_date,$new_end_date]);
                    })
                ->get();
        }
        // echo "<pre>";
        // print_r($pinjams->toArray());
        // exit();

        return view('peminjaman.index')
            ->with(compact('pinjams'))
            ->with(compact('final_new_start_date'))
            ->with(compact('final_new_end_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        return view('peminjaman.tambah', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no_id = $request->input('no_id');
        $name_user = $request->input('name_user');
        $kode_barang = $request->input('kode_barang');
        $name_barang = $request->input('name_barang');
        $tanggal_pinjam = $request->input('tanggal_pinjam');

        $barang = DB::table('barangs')
                ->where('kode_barang', '=', $kode_barang)
                ->take(1)
                ->get();
        $final_barang = $barang->toArray();
        $final_barang = $final_barang[0];
        
        //     [id] => 1
        //     [kode_barang] => B1000
        //     [name] => Printer Canon
        //     [tipe] => Pixma iP2770
        //     [tahun] => 2010
        //     [jumlah] => 4
        $finalBarang_id = $final_barang->id;
        $finalBarang_kode_barang = $final_barang->kode_barang;
        $finalBarang_name = $final_barang->name;
        $finalBarang_tipe = $final_barang->tipe;
        $finalBarang_tahun = $final_barang->tahun;
        $finalBarang_jumlah = $final_barang->jumlah;
        $final_skema_barang = array(
            'finalBarang_id' => $finalBarang_id,
            'finalBarang_kode_barang' => $finalBarang_kode_barang,
            'finalBarang_name' => $finalBarang_name,
            'finalBarang_tipe' => $finalBarang_tipe,
            'finalBarang_tahun' => $finalBarang_tahun,
            'finalBarang_jumlah' => $finalBarang_jumlah
        );
        
        if ($finalBarang_jumlah >= 1) {
            // insert ke database
            $validatedData = $request->validate([
                'no_id' => 'required|max:12',
                'name_user' => 'required|max:20',
                'kode_barang' => 'required|max:12',
                'name_barang' => 'required|max:20',
                'tanggal_pinjam' => 'required',
            ]);

            // update jumlah barang
            $final_update_jumlah_barang = $finalBarang_jumlah - 1;
            DB::table('barangs')
                ->where('id', $finalBarang_id)
                ->update(['jumlah' => $final_update_jumlah_barang]);
            
            Peminjaman::create($validatedData);
            return redirect('/peminjaman')->with('success', 'Tambah peminjaman berhasil!');
        } else {
            return redirect('/peminjaman/create')->with('error', 'Stok barang habis!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjams = Peminjaman::findOrFail($id);
        return view('peminjaman.edit', compact('pinjams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get data peminjamen berdasarkan id untuk mendapatkan kode_barang
        $peminjamen = DB::table('peminjamen')
                ->where('id', '=', $id)
                ->take(1)
                ->get();
        $final_peminjamen = $peminjamen->toArray();
        $final_peminjamen = $final_peminjamen[0];
        $kode_barang = $final_peminjamen->kode_barang;

        // get id berdasarkan kode_barang dari tabel barangs
        $barang = DB::table('barangs')
                ->where('kode_barang', '=', $kode_barang)
                ->take(1)
                ->get();
        $final_barang = $barang->toArray();
        $final_barang = $final_barang[0];
        
        $finalBarang_id = $final_barang->id;
        $finalBarang_jumlah = $final_barang->jumlah;
        $final_skema_barang = array(
            'finalBarang_id' => $finalBarang_id,
            'finalBarang_jumlah' => $finalBarang_jumlah
        );
        // echo "<pre>";
        // print_r($final_barang);
        // exit();

        // update jumlah barang
        $final_update_jumlah_barang = $finalBarang_jumlah + 1;
        DB::table('barangs')
            ->where('id', $finalBarang_id)
            ->update(['jumlah' => $final_update_jumlah_barang]);

        $pinjams = Peminjaman::findOrFail($id);
        $pinjams->update($request->all());
        return redirect('/peminjaman')->with('success', 'Edit peminjaman berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjams = Peminjaman::findOrFail($id);
        $pinjams->delete();
        return redirect('/peminjaman')->with('success', 'Hapus peminjaman berhasil!');
    }
}
