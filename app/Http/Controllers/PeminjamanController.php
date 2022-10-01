<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use PDF;

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
        $url_ngrok = DB::table('dev_setting')
                ->where('code', '=', 'url_ngrok')
                ->take(1)
                ->get();
        $dev_setting = $url_ngrok->toArray();
        $dev_setting = $dev_setting[0];

        $final_url_ngrok = $dev_setting->value;

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
            ->with(compact('final_new_end_date'))
            ->with(compact('final_url_ngrok'));
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
        $tanggal_kembali = $request->input('tanggal_kembali');

        $barang = DB::table('barangs')
                ->where('kode_barang', '=', $kode_barang)
                ->take(1)
                ->get();
        $final_barang = $barang->toArray();
        $final_barang = $final_barang[0];
        
        $finalBarang_id = $final_barang->id;
        $finalBarang_kode_barang = $final_barang->kode_barang;
        $finalBarang_name = $final_barang->name;
        $finalBarang_tipe = $final_barang->tipe;
        $finalBarang_tahun = $final_barang->tahun;
        $finalBarang_status = $final_barang->status;
        $finalBarang_kondisi = $final_barang->kondisi;
        $final_skema_barang = array(
            'finalBarang_id' => $finalBarang_id,
            'finalBarang_kode_barang' => $finalBarang_kode_barang,
            'finalBarang_name' => $finalBarang_name,
            'finalBarang_tipe' => $finalBarang_tipe,
            'finalBarang_tahun' => $finalBarang_tahun,
            'finalBarang_status' => $finalBarang_status,
            'finalBarang_kondisi' => $finalBarang_kondisi
        );
        
        if ($finalBarang_kondisi == 'baik') {
            // insert ke database
            $validatedData = $request->validate([
                'no_id' => 'required|max:12',
                'name_user' => 'required|max:20',
                'kode_barang' => 'required|max:12',
                'name_barang' => 'required|max:20',
                'tanggal_pinjam' => 'required',
                'tanggal_kembali' => 'required',
            ]);

            // update status barang
            $final_update_status = $finalBarang_status = 'dipinjam';
            DB::table('barangs')
                ->where('id', $finalBarang_id)
                ->update(['status' => $final_update_status]);
            
            Peminjaman::create($validatedData);
            return redirect('/peminjaman')->with('success', 'Tambah peminjaman berhasil!');
        } else {
            return redirect('/peminjaman/create')->with('error', 'Pilih barang lain, barang rusak!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_barang)
    {
        $peminjamen = DB::table('peminjamen')
                ->where('kode_barang', '=', $kode_barang)
                ->get();
        $final_peminjamen = $peminjamen->toArray();
        $final_peminjamen = end($final_peminjamen);

        $id_final = $final_peminjamen->id;
        $no_id_final = $final_peminjamen->no_id;
        $name_user_final = $final_peminjamen->name_user;
        $kode_barang_final = $final_peminjamen->kode_barang;
        $name_barang_final = $final_peminjamen->name_barang;
        $tanggal_pinjam_final = $final_peminjamen->tanggal_pinjam;
        $tanggal_kembali_final = $final_peminjamen->tanggal_kembali;
        $status_final = $final_peminjamen->status;
        $final_skema_pinjam = array(
            'id_final' => $id_final,
            'no_id_final' => $no_id_final,
            'name_user_final' => $name_user_final,
            'kode_barang_final' => $kode_barang_final,
            'name_barang_final' => $name_barang_final,
            'tanggal_pinjam_final' => $tanggal_pinjam_final,
            'tanggal_kembali_final' => $tanggal_kembali_final,
            'status_final' => $status_final
        );
        // echo "<pre>";
        // print_r($peminjamen);
        // exit();
        
            return view('peminjaman.show', compact('final_skema_pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_barang)
    {
        $peminjamen = DB::table('peminjamen')
                ->where('kode_barang', '=', $kode_barang)
                ->get();
        $final_peminjamen = $peminjamen->toArray();
        $final_peminjamen = end($final_peminjamen);

        $id_final = $final_peminjamen->id;
        $kode_barang_final = $final_peminjamen->kode_barang;
        $status_final = $final_peminjamen->status;
        $final_skema_pinjam = array(
            'id_final' => $id_final,
            'kode_barang_final' => $kode_barang_final,
            'status_final' => $status_final
        );

        $barangs = DB::table('barangs')
                ->where('kode_barang', '=', $kode_barang)
                ->take(1)
                ->get();
        $final_barangs = $barangs->toArray();
        $final_barangs = $final_barangs[0];

        $id_final = $final_barangs->id;
        $kondisi_final = $final_barangs->kondisi;
        $final_skema_barang = array(
            'id_final' => $id_final,
            'kondisi_final' => $kondisi_final
        );

        // echo "<pre>";
        // print_r($final_skema_pinjam);
        // exit();

        return view('peminjaman.edit')
            ->with(compact('final_skema_pinjam'))
            ->with(compact('final_skema_barang'));
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
        $finalBarang_status = $final_barang->status;
        $final_skema_barang = array(
            'finalBarang_id' => $finalBarang_id,
            'finalBarang_status' => $finalBarang_status
        );
        // echo "<pre>";
        // print_r($final_barang);
        // exit();

        // update status barang
        $final_update_status = $finalBarang_status = 'tersedia';
        DB::table('barangs')
            ->where('id', $finalBarang_id)
            ->update(['status' => $final_update_status]);

        $barang = Barang::find($kode_barang);
        $barang = Barang::where('kode_barang',$kode_barang)->first();
        $barang->kondisi = $request->input('kondisi');
        $barang->save();

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

    public function peminjaman_by_kode_barang($kode_barang)
    {
        $peminjamen = DB::table('peminjamen')
                ->where('kode_barang', '=', $kode_barang)
                ->get();
        $final_peminjamen = $peminjamen->toArray();
        $final_peminjamen = end($final_peminjamen);

        $barangs = DB::table('barangs')
                ->where('kode_barang', '=', $kode_barang)
                ->take(1)
                ->get();
        $final_barangs = $barangs->toArray();
        $final_barangs = $final_barangs[0];

        $id_final = $final_barangs->id;
        $kode_barang_final = $final_barangs->kode_barang;
        $name_final = $final_barangs->name;
        $tipe_final = $final_barangs->tipe;
        $tahun_final = $final_barangs->tahun;
        $status_final_pinjam = $final_barangs->status;
        $image_final = $final_barangs->image;
        $final_skema_barang = array(
            'id_final' => $id_final,
            'kode_barang_final' => $kode_barang_final,
            'name_final' => $name_final,
            'tipe_final' => $tipe_final,
            'tahun_final' => $tahun_final,
            'status_final_pinjam' => $status_final_pinjam,
            'image_final' => $image_final
        );
        
        if ($status_final_pinjam == 'tersedia') {
            return view('barang.show', compact('final_skema_barang'));
        } else {
            $id_final = $final_peminjamen->id;
            $no_id_final = $final_peminjamen->no_id;
            $name_user_final = $final_peminjamen->name_user;
            $kode_barang_final = $final_peminjamen->kode_barang;
            $name_barang_final = $final_peminjamen->name_barang;
            $tanggal_pinjam_final = $final_peminjamen->tanggal_pinjam;
            $tanggal_kembali_final = $final_peminjamen->tanggal_kembali;
            $status_final = $final_peminjamen->status;
            $final_skema_pinjam = array(
                'id_final' => $id_final,
                'no_id_final' => $no_id_final,
                'name_user_final' => $name_user_final,
                'kode_barang_final' => $kode_barang_final,
                'name_barang_final' => $name_barang_final,
                'tanggal_pinjam_final' => $tanggal_pinjam_final,
                'tanggal_kembali_final' => $tanggal_kembali_final,
                'status_final' => $status_final
            );
            return view('peminjaman.show', compact('final_skema_pinjam'));
        }
    }

    public function autocomplete11(Request $request)
    {
        $data = User::select("no_id as value", "id")
                    ->where('no_id', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocomplete12(Request $request)
    {
        $data = User::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocomplete13(Request $request)
    {
        $data = Barang::select("kode_barang as value", "id")
                    ->where('kode_barang', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocomplete14(Request $request)
    {
        $data = Barang::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function report(Barang $barang, $id)
    {
        $pinjam = DB::table('peminjamen')->first();
        $pinjam = Peminjaman::findOrFail($id);
        // return view('peminjaman.report', compact('pinjam'));
        $pdf = PDF::loadview('peminjaman.report',['pinjam'=>$pinjam]);
	    return $pdf->stream();
    }
}
