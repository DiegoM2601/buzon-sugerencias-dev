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
        $areas = Area::where('state', 1)->get();
        return view('welcome', [
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
        // return $request->all();

        $movie = new Suggestion;
        //$movie->create($request->all());
        $movie->sede=$request->sede;
        $movie->carrera=$request->carrera;
        $movie->semestre=$request->semestre;
        $movie->area=$request->area;
        $movie->newarea=$request->newarea;
        /*if($request->newarea){
            $data=new Area;
            $data->area=$request->nuevaArea;
            $data->save();
            $movie->area=$request->nuevaArea;
        }else{
            $movie->area=$request->area;
        }*/
        $movie->categoria=$request->categoria;
        $movie->sugerencia=$request->sugerencia;
        $movie->by_=$request->by_;
        $movie->key=$request->key;
        $movie->ip=$request->ip;
        $movie->browser=$request->browser;
        $movie->device=$request->device;
        $movie->country=$request->country;
        $movie->latitude=$request->latitude;
        $movie->longitude=$request->longitude;
        $movie->os=$request->os;
        $movie->save();
        


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
