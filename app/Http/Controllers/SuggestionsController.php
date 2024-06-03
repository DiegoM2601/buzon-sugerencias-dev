<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Http;
use Response;
// use Request;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areas = Area::where('deleted', 0)->get();

        if ($request->has('help')) {
            return view('welcome', [
                'help' => true,
            ]);
        }
        if ($request->hasHeader("DENEGADO")) {
            return view('error');
        }
        if ($request->hasHeader("GPS-DENEGADO")) {
            return view('error', [
                'gps_denegado' => true,
            ]);
        }
        return view('welcome', [
            'areas' => $areas,
        ]);
    }

    public function help()
    {
        return view("instrucciones-help");
    }

    public function error(Request $request)
    {
        if ($request->has('permiso')) {
            return view('acceso-restringido', [
                'type' => 'permiso',
            ]);
        }
        if ($request->has('sede')) {
            return view('acceso-restringido', [
                'type' => 'sede',
            ]);
        }

        return view('acceso-restringido', [
            'type' => 'default',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suggestion = new Suggestion;
        $suggestion->sede = $request->sede;
        $suggestion->carrera = $request->carrera;
        $suggestion->semestre = $request->semestre;
        $suggestion->area_id = $request->area;
        $suggestion->newarea = $request->newarea;
        $suggestion->categoria = $request->categoria;
        $suggestion->sugerencia = $request->sugerencia;
        $suggestion->by_ = $request->by_;
        $suggestion->key = $request->key;
        $suggestion->ip = $request->ip;
        $suggestion->browser = $request->browser;
        $suggestion->device = $request->device;
        $suggestion->country = $request->country;
        $suggestion->latitude = $request->latitude;
        $suggestion->longitude = $request->longitude;
        $suggestion->os = $request->os;
        $suggestion->save();



        return ["Success"];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}