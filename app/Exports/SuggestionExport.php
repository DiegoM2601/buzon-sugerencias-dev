<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Suggestion;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;
class SuggestionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $searchParams;
    protected $startDate;
    protected $endDate;

    public function __construct($searchParams, $startDate = null, $endDate = null)
    {
        $this->searchParams = $searchParams;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return [
            'id',
            'carrera',
            'sede',
            'semestre',
            'area',
            'newarea',
            'categoria',
            'by_',
            'sugerencia',
            'key',
            'created_at'
        ];
    }

    public function collection()
    {
        $query = Suggestion::select('id','carrera','sede','semestre','area','newarea','categoria','by_','sugerencia','key','created_at');

        foreach ($this->searchParams as $key => $value) {
            if ($value) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }
        return $query->get();
    }
}

