<?php

namespace App\Http\Controllers;

use App\Models\Area as ModelsArea;
use App\Models\Sub_area;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use Models\Area;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = ModelsArea::all();
        return view('areas', compact('areas'));
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
        //
        $areas = new ModelsArea();
        $areas->area = $request->input('area');
        $areas->save();
        return redirect()->back();
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
        $areas = ModelsArea::find($id);
        return view('areas.area', compact('areas.area'));
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

    public function updateSubarea(Request $request)
    {
        $subarea = Sub_area::find($request->idSubarea);
        $subarea->subarea = $request->subarea;
        $subarea->save();

        return response()->json($subarea);
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
        $areas = ModelsArea::find($id);
        $areas->area = $request->input('area');
        $areas->update();
        return redirect()->back();
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
        $areas = ModelsArea::find($id);
        $areas->delete();
        return redirect()->back();
    }
}
