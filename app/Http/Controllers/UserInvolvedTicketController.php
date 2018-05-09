<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersInvolvedTicket;

class UserInvolvedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInvolved=UsersInvolvedTicket::all();
        return response($userInvolved);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UsersInvolvedTicket::create($request->all());
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
        $userInvolved=UsersInvolvedTicket::find($id);
        return response()->json($userInvolved);
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
       $userInvolved=UsersInvolvedTicket::find($id);
       $userInvolved->fill($request->all());
       $userInvolved->save();
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
        $userInvolved=UsersInvolvedTicket::find($id);
        $userInvolved->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
