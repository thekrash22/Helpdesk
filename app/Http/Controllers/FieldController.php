<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;


class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $field=Field::all();
        return response($field);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Field::create($request->all());
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
        $field=Field::find($id);
        return response()->json($field);
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
       $field=Field::find($id);
       $field->fill($request->all());
       $field->save();
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
        $field=Field::find($id);
        $field->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    
    public function fieldByName($id){
        $field=Field::where('name_form_id', '=', $id)->get();
        return response($field);
    }
}
