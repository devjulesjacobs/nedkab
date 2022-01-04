<?php

namespace App\Imports;

use App\Cable;
use Maatwebsite\Excel\Concerns\ToModel;

class CablesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return $row;
//        return new Cable([
//            'description' => $row[0]
//        ]);
    }
}
