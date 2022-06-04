<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    
    public function headings():array{
        return [
            'NIP',
            'Nama',
            'Email',
            'Phone',
            'Gender'
        ];
    }
    
    
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        return collect(User::getGuru());
    }
}
