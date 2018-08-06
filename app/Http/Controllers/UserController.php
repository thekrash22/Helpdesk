<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use App\Users;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=Users::paginate(15);
        return response($users);
    }
    
    public function all()
    {
        $users=Users::with('roles','area')->get();
        return response($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $pass=Hash::make($request->password);
        $area_id=$request->area['id'];
        $user=Users::create(['name'=>$request->name,
                      'email'=>$request->email,
                      'password'=>$pass,
                      'username'=>$request->username,
                      'area_id'=>$area_id,
                      'isActive'=> $request->isActive
                    ]);
        
        
        $role = Role::where('id', '=', $request->role)->first();
        $user->attachRole($role);
        return response(['Mensaje'=>'Creado Correctamente']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=Users::find($id);
        return response()->json($user);

        
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
        $user=User::find($id);
        
        $input = $request->all();
        if(isset($input['password'])){$input['password'] = Hash::make($input['password']);}
    	$user->fill($input);
    	$user->save();
		return response(["mensaje"=>"Actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();

        return response(["mensaje"=>"Eliminado correctamente"]);
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
        
    $user = Users::where('username', '=', $userObj->username)->with('roles', 'area')->get();
    return response()->json(compact('token', 'user'));
        
    }
}
