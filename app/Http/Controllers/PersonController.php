<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $person=Person::paginate(15);
        return response($person);
    }
    
    public function all()
    {
        $person=Person::all();
        return response($person);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Person::create($request->all());
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
        $person=Person::find($id);
        return response()->json($person);
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
       $person=Person::find($id);
       $person->fill($request->all());
       $person->save();
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
        $person=Person::find($id);
        $person->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    
    public function searchByDNI($type, $dni){
        $person=Person::where('dinType_id', '=' , $type)
                      ->where('dni', 'like', '%'.$dni.'%')
                      ->get();
        return response($person);
    }
}
