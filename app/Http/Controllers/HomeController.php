<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Sub_area;
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
        $areas = Area::orderBy('deleted', 'asc')->get();

        $searchParams = [
            'sede' => $request->get('search_sede'),
            'semestre' => $request->get('search_semestre'),
            'area_id' => $request->get('search_area'),
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

            // return response()->json($startDate);

            // dd($searchParams);
        }

        foreach ($searchParams as $key => $value) {
            if ($value) {
                // $query->where($key, 'like', '%' . $value . '%');
                // $query->where($key, 'like', $value);
                $query->where($key, $value);
            }
        }

        //comprobar el estado de los registros
        // $query->where("deleted", 0);

        $suggestions = $query->paginate(5);

        if ($request->hasHeader("AXIOS")) {
            return view('table-home', compact('suggestions'));
        }

        return view('home', compact('suggestions', 'searchParams', 'areas'));
    }

    public function getSuggestion($idSuggestion)
    {
        $sugerencia = Suggestion::find($idSuggestion);

        return response()->json($sugerencia);
    }

    //TODO: Trasladar una copia de la siguiente funcion a AreaController y modificar el crud areas frontend para usar esa funcion
    public function getSubareas($idArea)
    {
        // prioorizar registros activo
        // $subareas = Sub_area::where('area_id', $idArea)->get();
        $subareas = Sub_area::where('area_id', $idArea)
            ->orderBy('deleted', 'asc')
            ->get();
        return response()->json($subareas);
    }
    public function getAreas()
    {
        $areas = Area::all();
        return response()->json($areas);
    }

    public function export(Request $request)
    {
        $searchParams = [
            'sede' => $request->get('search_sede'),
            'semestre' => $request->get('search_semestre'),
            'area_id' => $request->get('search_area'),
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

        $consulta = new SuggestionExport($searchParams, $startDate, $endDate);

        // dd($consulta->collection());

        // return response()->json($consulta->collection());

        return Excel::download(
            $consulta,
            'reporte-buzon-sugerencias_' . date('Ymd') . '.xlsx'
        );
    }

    public function area()
    {
        $areas = Area::orderBy('id', 'ASC')->paginate(15);
        return view('areas.area', [
            'areas' => $areas
        ]);
    }

    public function prueba($idRegistro)
    {
        $sugerencia = Suggestion::find($idRegistro);
        // sede, categoria, participante, carrera, semestre, area, sugerencia, fecha


        // if ($sugerencia->sede === "CBB") {
        //     $sugerencia->sede = "LPZ";
        //     $sugerencia->save();
        // } else if ($sugerencia->sede === "LPZ") {
        //     $sugerencia->sede = "CBB";
        //     $sugerencia->save();
        // }

        // ! respuesta: {ejemplo: "LPZ"}
        // return response()->json(['ejemplo' => $sugerencia->sede]); 
        // ! respuesta: {sede: "LPZ", participante: "Docente", carrera: "...", ...}
        // return response()->json($sugerencia);
        // ! [{sede: "LPZ", participante: "Docente", carrera: "...", ...}, ...]
        // return response()->json([$sugerencia]);
    }

    public function updateSuggestion(Request $request)
    {
        $sugerencia = Suggestion::find($request->idSuggestion);

        $sugerencia->sede = $request->valoresSubida[0];
        $sugerencia->categoria = $request->valoresSubida[1];
        $sugerencia->by_ = $request->valoresSubida[2];
        $sugerencia->carrera = $request->valoresSubida[3];
        $sugerencia->semestre = $request->valoresSubida[4];
        $sugerencia->area_id = $request->valoresSubida[5];
        $sugerencia->subarea_id = $request->valoresSubida[6];
        $sugerencia->sugerencia = $request->valoresSubida[7];
        $sugerencia->created_at = Carbon::create($request->valoresSubida[8]);

        $sugerencia->save();

        $sugerencia->load('subarea');
        $sugerencia->load('objeto_area');

        return response()->json($sugerencia);
    }

    public function deleteSuggestion(Request $request)
    {
        $sugerencia = Suggestion::find($request->idSuggestion);
        $sugerencia->deleted = 1;
        $sugerencia->save();
        return response()->json($request->idSuggestion);
    }

    public function undoDeleteSuggestion(Request $request)
    {
        $sugerencia = Suggestion::find($request->idSuggestion);
        $sugerencia->deleted = 0;
        $sugerencia->save();
        return response()->json($request->idSuggestion);
    }

    public function pruebaEjemplo($id)
    {
        // FUNCIONA
        // $sugerencias = Sub_area::find($id)->suggestions;
        // dd([$sugerencias[0]->sede, $sugerencias[0]->area]);

        // $subarea = Suggestion::find($id);
        $subarea = Suggestion::with('subarea')
            ->find($id);

        // dd($subarea);
        return response()->json($subarea);
    }


    public function dashboard(Request $request)
    {
        $searchCategoria = $request->input('search_categoria');
        $searchBy = $request->input('search_by');
        $query = Suggestion::query();

        $hoy = Carbon::now();
        $haceUnaSemana = $hoy->subWeek();
        $haceUnMes = $hoy->subDays(30);
        // $suggestionCount = Suggestion::where('deleted', 0)->count();
        $sugerenciasUltimaSemana = Suggestion::where('created_at', '>=', $haceUnaSemana)->where('deleted', 0)
            ->count();
        $sugerenciasUltimoMes = Suggestion::where('created_at', '>=', $haceUnMes)->where('deleted', 0)
            ->count();
        //------------------------------------    
        $dateRange = $request->input('datefilter');
        if ($dateRange) {
            list($startDate, $endDate) = explode(' - ', $dateRange);

            // ! CORREGIR EL DESFACE 
            //TODO: hacer lo mismo en las consultas que hace la vista de sugerencias (y su reporte excel)
            $startDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d') . " " . "00:00:00";
            $endDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d') . " " . "23:59:59";

            // return response()->json(["inicio" => $startDate, "fin" => $endDate]);

            if ($searchCategoria && $searchCategoria !== '0') {
                $query->where('categoria', $searchCategoria);
            }
            if ($searchBy && $searchBy !== '0') {
                $query->where('by_', $searchBy);
            }
            $sugerenciasPorFecha = Suggestion::select(\DB::raw('date(created_at) as fecha'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('fecha')
                ->get();


            $sugerenciasPorSede = Suggestion::select('sede', \DB::raw('count(*) as total'))->where('deleted', 0)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('sede')
                ->get();

            $suggestionCount = Suggestion::where('deleted', 0)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->count();

            // return response()->json($contarSugerencias);

            // $sugerenciasPorArea = Suggestion::select('area', \DB::raw('count(*) as total'))
            //     ->whereBetween('created_at', [$startDate, $endDate])
            //     ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
            //         return $query->where('categoria', $searchCategoria);
            //     })
            //     ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
            //         return $query->where('by_', $searchBy);
            //     })
            //     ->groupBy('area')
            //     ->orderByDesc('total')
            //     ->get();


            // ! SOLO MOSTRAR EN EL CHART LAS AREAS QUE TENGAN REGISTROS ASOCIADOS A SUGERENCIAS
            $sugerenciasPorArea = DB::table('areas')
                ->leftJoin('suggestions', 'areas.id', '=', 'suggestions.area_id')
                ->whereBetween('suggestions.created_at', [$startDate, $endDate])
                ->where('areas.deleted', '=', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->select('areas.area', DB::raw('COUNT(suggestions.id) as total'))
                ->groupBy('areas.area')
                ->get();

            // ! MOSTRAR TODAS LAS AREAS, INCLUYENDO LAS QUE TENGAN 0 REGISTROS ASOCIADOS A SUGERENCIAS
            // $sugerenciasPorArea = DB::table('areas')
            //     ->leftJoin('suggestions', function ($join) use ($startDate, $endDate) {
            //         $join->on('areas.id', '=', 'suggestions.area_id')
            //             ->whereBetween('suggestions.created_at', [$startDate, $endDate]);
            //     })
            //     ->where('areas.deleted', '=', 0)
            //     ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
            //         return $query->where('categoria', $searchCategoria);
            //     })
            //     ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
            //         return $query->where('by_', $searchBy);
            //     })
            //     ->select('areas.area', DB::raw('COUNT(suggestions.id) as total'))
            //     ->groupBy('areas.area')
            //     ->get();



            $sugerenciasPorCarrera = Suggestion::select(\DB::raw('COALESCE(carrera, "Docente") as carrera'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('carrera')
                ->orderBy('total')
                ->get();


            $sugerenciasPorSemestre = Suggestion::select(\DB::raw('COALESCE(semestre, "Docente") as semestre'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('semestre')
                ->orderBy('total')
                ->get();
        } else {
            if ($searchCategoria && $searchCategoria !== '0') {
                $query->where('categoria', $searchCategoria);
            }
            if ($searchBy && $searchBy !== '0') {
                $query->where('by_', $searchBy);
            }
            $sugerenciasPorFecha = Suggestion::select(\DB::raw('date(created_at) as fecha'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('fecha')->get();
            $sugerenciasPorSede = Suggestion::select('sede', \DB::raw('count(*) as total'))->where('deleted', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('sede')->get();

            // $sugerenciasPorArea = Suggestion::select('area', \DB::raw('count(*) as total'))
            //     ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
            //         return $query->where('categoria', $searchCategoria);
            //     })
            //     ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
            //         return $query->where('by_', $searchBy);
            //     })
            //     ->groupBy('area')->orderByDesc('total')->get();

            // $x = Suggestion::join('areas', 'suggestions.area_id', '=', 'areas.id')
            //     ->select('areas.area', 'suggestions.id', DB::raw('COUNT(*) as cantidad'))->groupBy('areas.id')->get();

            // ! TODAS LAS AREAS
            // $sugerenciasPorArea = DB::table('areas')
            //     ->leftJoin('suggestions', 'areas.id', '=', 'suggestions.area_id')
            //     ->where('areas.deleted', '=', 0)
            //     ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
            //         return $query->where('categoria', $searchCategoria);
            //     })
            //     ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
            //         return $query->where('by_', $searchBy);
            //     })
            //     ->select('areas.area', DB::raw('COUNT(suggestions.id) as total'))
            //     ->groupBy('areas.area')
            //     ->get();

            // ! SOLO AREAS ASOCIADAS CON SUGERENCIAS
            $sugerenciasPorArea = DB::table('areas')
                ->join('suggestions', 'areas.id', '=', 'suggestions.area_id')
                ->where('areas.deleted', '=', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->select('areas.area', DB::raw('COUNT(suggestions.id) as total'))
                ->groupBy('areas.area')
                ->get();
            // * response:
            /**
             * * [
             * *      {"area":"Lorem ipsum dolor sit amet consectetur","total":2},
             * *      {"area":"Anfitriones\/Tutores\/Ayudantes\/Hnos Mayores","total":1},
             * *      {"area":"ARCA","total":2},{"area":"Caja","total":1},{"area":"Soporte T\u00e9cnico","total":3},
             * *      {"area":"Servicios Estudiantiles","total":2},{"area":"Biblioteca","total":2},{"area":"Cafeter\u00eda","total":5},
             * *      {"area":"Cl\u00ednica UNIFRANZ","total":7},{"area":"Fundaci\u00f3n UNIFRANZ","total":10},
             * * ]
             */

            // return response()->json($sugerenciasPorArea);

            $suggestionCount = Suggestion::where('deleted', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->count();


            $sugerenciasPorCarrera = Suggestion::select(\DB::raw('COALESCE(carrera, "Docente") as carrera'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('carrera')->orderBy('total')->get();
            $sugerenciasPorSemestre = Suggestion::select(\DB::raw('COALESCE(semestre, "Docente") as semestre'), \DB::raw('count(*) as total'))->where('deleted', 0)
                ->when($searchCategoria && $searchCategoria !== '0', function ($query) use ($searchCategoria) {
                    return $query->where('categoria', $searchCategoria);
                })
                ->when($searchBy && $searchBy !== '0', function ($query) use ($searchBy) {
                    return $query->where('by_', $searchBy);
                })
                ->groupBy('semestre')->orderBy('total')->get();
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

        ]);
    }
}