<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nip' => $row[1],
            'password' => bcrypt($row[1]),
            'name' => $row[2],
            'gender' => $row[3],
            'phone_no' => $row[4],
            'email' => $row[5],
            'level' => $row[7],
            'image' => $row[8],
        ]);
    }
}
