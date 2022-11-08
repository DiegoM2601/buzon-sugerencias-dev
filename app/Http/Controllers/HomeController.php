<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Exports\SuggestionExport;
use Maatwebsite\Excel\Facades\Excel;

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
    public function index()
    {
        // return view('home');

        $suggestions = Suggestion::orderBy('id', 'DESC')->paginate(15);
        return view('home', [
            'suggestions' => $suggestions
        ]);
    }

    public function export(){

        return Excel::download(new SuggestionExport, 'reporte-buzon-sugerencias_'.date('Ymd').'.xlsx');
    }
}
