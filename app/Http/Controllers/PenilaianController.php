<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penilaian;
use App\Alternatif;
use App\Kriteria;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PenilaianImport;
use DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria','ASC')->get();
        // return response()->json($alternatif);
        // return response()->json($kriteria);
        return view('admin.penilaian.index',compact('alternatif','kriteria'));


        // foreach ($alternatif as $alt => $valt) {
        //     echo count($valt->penilaian) . ', ';
        // }

    }

    public function store(Request $request)
    {
        //return response()->json($request);
        $alternatif = count($request->crips_id);
        try {
            DB::select("TRUNCATE penilaian");
            foreach ($request->crips_id as $key => $value) {
                foreach($value as $key_1 => $value_1)
                {
                    Penilaian::create([
                        'alternatif_id' => $key,
                        'crips_id'      => $value_1
                    ]);
                }
            }

            return back()->with('msg','Berhasil disimpan');
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine().
            "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    // public function importExcel(Request $request)
    // {
    //     Excel::import(new UsersImport, request()->file('file'));
    //     return back();
    // } 
    public function importExcel(Request $request)
    {
        Excel::import(new PenilaianImport, request()->file('file'));
        return back();
    }
}
