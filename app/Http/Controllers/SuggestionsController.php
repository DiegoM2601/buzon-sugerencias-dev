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
    public function index()
    {
        $areas = Area::where('deleted', 0)->get();

        $accessGranted = session('access_granted', false);

        // return $accessGranted

        return view('welcome', [
            'areas' => $areas,
            'accessGranted' => $accessGranted,
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