<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Suggestion;
<<<<<<< HEAD
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;
=======

>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
class SuggestionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
<<<<<<< HEAD
    protected $searchParams;
    protected $startDate;
    protected $endDate;

    public function __construct($searchParams, $startDate = null, $endDate = null)
    {
        $this->searchParams = $searchParams;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
=======
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df

    public function headings(): array
    {
        return [
            'id',
            'carrera',
            'sede',
            'semestre',
            'area',
<<<<<<< HEAD
            'newarea',
            'categoria',
            'by_',
=======
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
            'sugerencia',
            'key',
            'created_at'
        ];
    }

    public function collection()
    {
<<<<<<< HEAD
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

=======
        return Suggestion::select('id','carrera','sede','semestre','area','sugerencia','key','created_at')->get();
    }
}
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
