<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Suggestion;

class SuggestionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'id',
            'carrera',
            'sede',
            'semestre',
            'area',
            'sugerencia',
            'key',
            'created_at'
        ];
    }

    public function collection()
    {
        return Suggestion::select('id','carrera','sede','semestre','area','sugerencia','key','created_at')->get();
    }
}
