<?php

namespace App\Exports;

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Saving;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TabunganExportHarian implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Deposit',
            'Melalui',
            'Metode',
            'Tanggal'
        ];
    }

    public function map($saving): array
    {

        if($saving->payment)
        $jenis = $saving->payment->name;
        else
        $jenis = $saving->user->name;

        return [
            $saving->student->nis,
            $saving->student->name,
            $saving->student->grade->name,
            $saving->deposit,
            $jenis,
            $saving->method->name,
            date("d-m-Y", strtotime($saving->created_at))
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Saving::where('status', '1')
                    ->with('user', 'method', 'payment')
                    ->whereDate('created_at', Carbon::today())
                    ->get();
    }
}
