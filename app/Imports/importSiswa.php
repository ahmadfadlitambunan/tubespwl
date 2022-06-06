<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class importSiswa implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'grade_id' => $row[1],
            'nis' => $row[2],
            'name' => $row[3],
            'gender' => $row[4],
            'image' => $row[5],
            'password' => bcrypt($row[2]),
        ]);
    }
}
