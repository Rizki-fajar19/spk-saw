<?php

namespace App\Imports;

use App\Alternatif;
use Maatwebsite\Excel\Concerns\ToModel;

class AlternatifImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        echo $row[0];
        // return Alternatif::create([
        //     'nama_alternatif' => $row[0],
        // ]);
    }
}
