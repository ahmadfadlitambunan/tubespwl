<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSiswaPerkelas implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
        ];
    }

    public function map($student): array
    {

        return [
            $student->nis,
            $student->name
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $classes = Grade::where('user_id', auth()->user()->id)->get();
        foreach($classes as $item){
            $class_id = $item['id'];
        }
        return Student::where('grade_id', $class_id)->get();
    }
}
