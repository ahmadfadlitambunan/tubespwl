<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportKelas implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            'Kelas',
            'Wali Kelas',
        ];
    }

    public function map($grade): array
    {

        return [
            $grade->name,
            $grade->user->name,
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grade::with('user')->get();
    }
}
