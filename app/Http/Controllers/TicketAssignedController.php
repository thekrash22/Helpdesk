<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketAssignedUser;


class TicketAssignedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketAssigned=TicketAssignedUser::all();
        return response($ticketAssigned);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TicketAssignedUser::create($request->all());
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
        $ticketAssigned=TicketAssignedUser::find($id);
        return response()->json($ticketAssigned);
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
       $ticketAssigned=TicketAssignedUser::find($id);
       $ticketAssigned->fill($request->all());
       $ticketAssigned->save();
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
        $ticketAssigned=TicketAssignedUser::find($id);
        $ticketAssigned->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
