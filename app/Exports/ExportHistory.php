<?php

namespace App\Exports;

use App\Models\Saving;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Auth;

class ExportHistory implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            'Tanggal',
            'Uang Masuk',
            'Verifikator'
        ];
    }

    public function map($saving): array
    {

        return [
            date('d-m-Y', strtotime($saving->created_at)),
            $saving->deposit,
            $saving->user->name
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Saving::where('student_id', Auth::guard('student')->user()->id)
                        ->where('status', '1')
                        ->whereNotNull('user_id')
                        ->get();
    }
}
