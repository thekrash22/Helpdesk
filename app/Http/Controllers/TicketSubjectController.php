<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketSubject;

class TicketSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketSubject=TicketSubject::all();
        return response($ticketSubject);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TicketSubject::create($request->all());
        return response(['mensaje'=>'Creado Correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticketSubject=TicketSubject::find($id);
        return response()->json($ticketSubject);
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
       $ticketSubject=TicketSubject::find($id);
       $ticketSubject->fill($request->all());
       $ticketSubject->save();
       return response(['mensaje'=>'Actualizado Correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticketSubject=TicketSubject::find($id);
        $ticketSubject->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
