<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Exports\SuggestionExport;
use App\Models\Area;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $areas = Area::orderBy('id', 'ASC')->get();
        $searchParams = [
            'sede' => $request->get('search_sede'),
            'semestre' => $request->get('search_semestre'),
            'area' => $request->get('search_area'),
            'by_' => $request->get('search_by'),
            'categoria' => $request->get('search_categoria'),
        ];
        $query = Suggestion::orderBy('id', 'DESC');
        
        $dateRange = $request->input('datefilter');
        $dates = explode(' - ', $dateRange);
        if ($dateRange) {
            $startDate = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        foreach ($searchParams as $key => $value) {
            if ($value) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
        $suggestions = $query->paginate(15);
        return view('home', compact('suggestions', 'searchParams','areas'));
    }

    public function export(Request $request)
    {
        $searchParams = [
            'sede' => $request->get('search_sede'),
            'semestre' => $request->get('search_semestre'),
            'area' => $request->get('search_area'),
            'by_' => $request->get('search_by'),
            'categoria' => $request->get('search_categoria'),
        ];

        $dateRange = $request->input('datefilter');
        $dates = explode(' - ', $dateRange);
        $startDate = null;
        $endDate = null;

        if ($dateRange) {
            $startDate = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
        }

        return Excel::download(
            new SuggestionExport($searchParams, $startDate, $endDate),
            'reporte-buzon-sugerencias_' . date('Ymd') . '.xlsx'
        );
    }
    
    public function area(){
        $areas = Area::orderBy('id', 'ASC')->paginate(15);
        return view('areas.area', [
            'areas' => $areas
        ]);
    }
    

    public function dashboard(Request $request)
    {
        $searchCategoria = $request->input('search_categoria');
        $searchBy = $request->input('search_by');
        $query = Suggestion::query();

        $hoy = Carbon::now();
        $haceUnaSemana = $hoy->subWeek();
        $haceUnMes = $hoy->subDays(30);
        $suggestionCount = Suggestion::count();
        $sugerenciasUltimaSemana = Suggestion::where('created_at', '>=', $haceUnaSemana)
            ->count();
        $sugerenciasUltimoMes = Suggestion::where('created_at', '>=', $haceUnMes)
            ->count();
        //------------------------------------    
        $dateRange = $request->input('datefilter');
        if ($dateRange) {
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            if ($searchCategoria && $searchCategoria !== '0') {
                $query->where('categoria', $searchCategoria);
            }
            if ($searchBy && $searchBy !== '0') {
                $query->where('by_', $searchBy);
            }
            $sugerenciasPorFecha = Suggestion::select(\DB::raw('date(created_at) as fecha'), \DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('fecha')
                ->get();
            $sugerenciasPorSede = Suggestion::select('sede', \DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('sede')
                ->get();
            $sugerenciasPorArea = Suggestion::select('area', \DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('area')
                ->orderByDesc('total')
                ->get();
            $sugerenciasPorCarrera = Suggestion::select(\DB::raw('COALESCE(carrera, "Sin carrera") as carrera'),\DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('carrera')
                ->orderBy('total')
                ->get();
            $sugerenciasPorSemestre = Suggestion::select(\DB::raw('COALESCE(semestre, "Sin semestre") as semestre'),\DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('semestre')
                ->orderBy('total')
                ->get();
            $sugerenciasDeNuevasAreas = Suggestion::select(\DB::raw('COALESCE(newarea,"N/A") as newarea'),\DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('newarea')->orderByDesc('total')->get(); 
        } else {
            if ($searchCategoria && $searchCategoria !== '0') {
                $query->where('categoria', $searchCategoria);
            }
            if ($searchBy && $searchBy !== '0') {
                $query->where('by_', $searchBy);
            }
            $sugerenciasPorFecha = Suggestion::select(\DB::raw('date(created_at) as fecha'), \DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('fecha')->get();
            $sugerenciasPorSede = Suggestion::select('sede', \DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('sede')->get();
            $sugerenciasPorArea = Suggestion::select('area', \DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('area')->orderByDesc('total')->get();
            $sugerenciasPorCarrera = Suggestion::select(\DB::raw('COALESCE(carrera, "Sin carrera") as carrera'),\DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('carrera')->orderBy('total')->get();
            $sugerenciasPorSemestre = Suggestion::select(\DB::raw('COALESCE(semestre, "Sin semestre") as semestre'),\DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('semestre')->orderBy('total')->get();
            $sugerenciasDeNuevasAreas = Suggestion::select(\DB::raw('COALESCE(newarea, "N/A") as newarea'),\DB::raw('count(*) as total'))
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) { return $query->where('categoria', $searchCategoria);})
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) { return $query->where('by_', $searchBy);})
                ->groupBy('newarea')->orderByDesc('total')->get();    
        }
        return view('dashboard', [
            'suggestionCount' => $suggestionCount,
            'sugerenciasUltimaSemana' => $sugerenciasUltimaSemana,
            'sugerenciasUltimoMes' => $sugerenciasUltimoMes,
            'sugerenciasPorSede' => $sugerenciasPorSede,
            'sugerenciasPorArea' => $sugerenciasPorArea,
            'sugerenciasPorFecha' => $sugerenciasPorFecha,
            'sugerenciasPorCarrera' => $sugerenciasPorCarrera,
            'sugerenciasPorSemestre' => $sugerenciasPorSemestre,
            'sugerenciasDeNuevasAreas' => $sugerenciasDeNuevasAreas,
            
        ]);
    }
}
