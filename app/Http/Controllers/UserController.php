<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    
    public function auth(Request $request)
    {
        $credenciales = $request->only('username','password');
        $token=null;
        
        try{
            if(!$token=JWTAuth::attempt($credenciales))
            {
                return response()->json(['mensaje' => 'Contraseña o Usuario Invalidos'],401);
            }
        }catch(JWTException $ex){
            return response()->json(['error' => 'Algo esta mal'],500);
        }
        
        $userObj = JWTAuth::toUser($token);
        
        $user = User::where('username', '=', $userObj->username)->get();
        return response()->json(compact('token','user'));
        
    }
}