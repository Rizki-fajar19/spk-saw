<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternatif;

class AlternatifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['alternatif'] = Alternatif::get();
        return view('admin.alternatif.index',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_alternatif' => 'required|string',

        ]);

        try {
            $alternatif = new Alternatif();
            $alternatif->nama_alternatif = $request->nama_alternatif;
            $alternatif->save();
            return back()->with('msg','Berhasil menambahkan data');
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine().
            "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    public function edit($id)
    {
        $data['alternatif'] = Alternatif::findOrFail($id);
        return view('admin.alternatif.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_alternatif' => 'required|string',
        ]);

        try {
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->update([
                'nama_alternatif' => $request->nama_alternatif,
            ]);
            return back()->with('msg','Berhasil merubah data');
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine().
            "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    public function destroy($id)
    {
        try {
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->delete();
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine().
            "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    public function show($id)
    {
        $data['crips'] = Crips::where('kriteria_id', $id)->get();
        $data['kriteria'] = Kriteria::findOrFail($id);
        return view('admin.kriteria.show', $data);
    }
}
