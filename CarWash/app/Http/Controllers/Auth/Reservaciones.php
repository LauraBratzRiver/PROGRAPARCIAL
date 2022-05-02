<?php

namespace App\Http\Controllers;

use App\Reservacion;
use Illuminate\Http\Request;

class Reservaciones extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reservaciones::get(); //retorna todos los registros
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
        $id = Reservaciones::create($request->all())->id; //
        return response()->json(['id'=>$id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservacion  $Reservacion
     * @return \Illuminate\Http\Response
     */
    public function show(Reservacion $Reservacion)
    {
        return $Reservacion; //retorna un registro
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservacion  $Reservacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservacion $Reservacion)
    {
        //
    }

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservacion  $Reservacion
     * @return \Illuminate\Http\Response
     */
    
     public function update(Request $request, Reservacion $Reservacion)
    {
        $Reservacion->update($request->all());
        return response()->json(['id'=>$request->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservacion  $Reservacion
     * @return \Illuminate\Http\Response
     */
     public function destroy(Reservacion $Reservacion)
    {
        $Reservacion->delete();
        return response()->json(['id'=>$Reservacion->id], 200);
    }
    {
        
    }




