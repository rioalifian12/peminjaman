<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DNS2D;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = Barang::all();
        // return view('barang.index', compact('datas'));
        $datas = DB::table('barangs')->orderBy('id', 'DESC')->paginate(5);
        return view('barang.index', compact('datas'));
    }


    function importData(Request $request)
    {
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $the_file = $request->file('uploaded_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'E', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'kode_barang' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'name' => $sheet->getCell( 'B' . $row )->getValue(),
                    'tipe' => $sheet->getCell( 'C' . $row )->getValue(),
                    'tahun' => $sheet->getCell( 'D' . $row )->getValue(),
                    'jumlah' => $sheet->getCell( 'E' . $row )->getValue(),
                    // 'Country' =>$sheet->getCell( 'F' . $row )->getValue(),
                ];
                $startcount++;
            }
            DB::table('barangs')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('Upload data barang gagal!');
        }
        return back()->withSuccess('Upload data barang berhasil!');
    }

    public function ExportExcel($barang_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($barang_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            header('Content-Transfer-Encoding: BINARY');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    
    function exportData(){
        $data = DB::table('barangs')->orderBy('id', 'DESC')->get();
        $data_array [] = array("kode_barang","name","tipe","tahun","jumlah");
        foreach($data as $data_item)
        {

            $data_array[] = array(
                'kode_barang' =>$data_item->kode_barang,
                'name' => $data_item->name,
                'tipe' => $data_item->tipe,
                'tahun' => $data_item->tahun,
                'jumlah' => $data_item->jumlah
            );
        }
        $this->ExportExcel($data_array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.tambah');
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
            'kode_barang' => 'required|max:12',
            'name' => 'required|max:15',
            'tipe' => 'required|max:30',
            'tahun' => 'required|max:4',
            'jumlah' => 'required|max:3',
        ]);

        Barang::create($validatedData);
        return redirect('/barang')->with('success', 'Tambah barang berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Barang::findOrFail($id);
        $data->update($request->all());
        return redirect('/barang')->with('success', 'Edit barang berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Barang::findOrFail($id);
        $data->delete();
        return redirect('/barang')->with('success', 'Hapus barang berhasil!');
    }
}
