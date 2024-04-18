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
        return view('areas.area', [
            'areas' => $areas
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

    public function createSubarea(Request $request)
    {
        $subarea = new Sub_area();
        $subarea->subarea = $request->subarea;
        $subarea->area_id = $request->areaId;
        $subarea->save();

        return response()->json(["subareaId" => $subarea->id]);
    }

    public function deleteSubarea(Request $request)
    {
        $subarea = Sub_area::find($request->subareaId);
        $subarea->deleted = 1;
        $subarea->save();

        $sugerencias = Suggestion::where('subarea_id', $request->subareaId)->get();

        // foreach ($sugerencias as $sugerencia) {
        //     $sugerencia->subarea_id = null;
        //     $sugerencia->save();
        // }

        return response()->json(["onDeleteSuggestions" => count($sugerencias)]);
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

    // TODO: Cambiar stated por deleted EN LA BASE DE DATOS
    public function destroy($id)
    {
        $area = ModelsArea::find($id);
        $area->deleted = 1;
        $area->save();

        // eliminacion logica de las subareas pertenecientes a este area
        $subareas = Sub_area::where('area_id', $id)->get();
        foreach ($subareas as $subarea) {
            $subarea->deleted = 1;
            $subarea->save();
        }

        return redirect()->back();
    }

    public function undoDelete(Request $request)
    {
        $area = ModelsArea::find($request->areaId);
        $area->deleted = 0;
        $area->save();

        // las subareas permenecen desactivadas
        return redirect()->back();
    }
}