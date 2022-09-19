<?php

namespace App\Imports;

use App\Alternatif;
use Maatwebsite\Excel\Concerns\ToModel;

class PenilaianImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nama = $row[0];
        // echo $nama;
        // return new Alternatif([
        //     'nama_alternatif' => $row[0],
        // ]);
        $alternatif = new Alternatif();
        $alternatif->nama_alternatif = $nama;
        $alternatif->save();
        
    }
}
