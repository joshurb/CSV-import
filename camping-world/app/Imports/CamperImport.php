<?php

namespace App\Imports;

use App\Models\Camper;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CamperImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Camper([
            'camper_make' => $row[0],
            'camper_brand' => $row[1],
            'sleep_number' => ($row[2]=='n/a')?null:$row[2],
            'price' => ($row[3]=='n/a')?null:$row[3],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
