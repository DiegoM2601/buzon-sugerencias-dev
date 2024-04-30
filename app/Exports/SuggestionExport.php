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
            'sede',
            'participante',
            'carrera',
            'semestre',
            'categoria',
            'area',
            'subarea',
            'sugerencia',
            'key',
            'created_at'
        ];
        // return [
        //     'id',
        //     'sede',
        //     'carrera',
        //     'semestre',
        //     'area',
        //     'newarea',
        //     'categoria',
        //     'by_',
        //     'sugerencia',
        //     'key',
        //     'created_at'
        // ];
    }

    public function collection()
    {
        $query = Suggestion::join('areas', 'suggestions.area_id', '=', 'areas.id')
            ->leftJoin('sub_areas', 'suggestions.subarea_id', '=', 'sub_areas.id')
            ->select('suggestions.id', 'suggestions.sede', 'suggestions.by_', 'suggestions.carrera', 'suggestions.semestre', 'suggestions.categoria', 'areas.area', 'sub_areas.subarea', 'suggestions.sugerencia', 'suggestions.key', 'suggestions.created_at');

        // ! agregar prefijo suggestions. a los parametros de busqueda de lo contrario existirá ambiguedad en la consulta debido al join
        $searchParamsSuggestions = array_combine(array_map(function ($clave) {
            return "suggestions." . $clave;
        }, array_keys($this->searchParams)), $this->searchParams);


        foreach ($searchParamsSuggestions as $key => $value) {
            if ($value) {
                $query->where($key, $value);
            }
        }


        if ($this->startDate && $this->endDate) {
            $query->whereBetween('suggestions.created_at', [$this->startDate, $this->endDate]);
        }

        // exportar solo registros activos
        $query->where("suggestions.deleted", 0);

        return $query->get();
    }
}
