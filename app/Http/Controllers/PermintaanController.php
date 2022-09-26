<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if($auth_role  == "superadmin" || $auth_role == "admin") {
            $datas = Permintaan::all();
        } else {
             $datas = DB::table('permintaans')
                ->where('no_id', '=', $auth_no_id)
                ->get();
        }
        // echo "<pre>";
        // print_r($pinjams->toArray());
        // exit();

        return view('permintaan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $barang = $barang->except(['rusak']);
        return view('permintaan.tambah', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_id' => 'required|max:12',
            'name_user' => 'required|max:20',
            'name_barang' => 'required|max:20',
        ]);

        Permintaan::create($validatedData);
        return redirect('/permintaan')->with('success', 'Tambah peminjaman berhasil!');
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
        $datas = Permintaan::findOrFail($id);
        return view('permintaan.edit', compact('datas'));
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
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        $datas = Permintaan::findOrFail($id);
        $datas->update($validatedData);
        return redirect('/permintaan')->with('success', 'Edit peminjaman berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas = Permintaan::findOrFail($id);
        $datas->delete();
        return redirect('/permintaan')->with('success', 'Hapus peminjaman berhasil!');
    }

    public function autocomplete(Request $request)
    {
        $data = Barang::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}
