<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Form;
use App\FormField;
use App\Files;
use App\Tracking;
use App\User;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thread=Thread::all();
        return response($thread);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create to thread
        
        $thread=Thread::create($request->all());
        
        //vars load to for each insert...
        
        $type=$request->type;
        $fields=$request->fields;
        
        
        //get forms and create
        switch ($type) {
            case 'tecnico':
                
                $form=Form::create(['thread_id'=>$thread->id,
                                    'name_form_id'=>1
                                    ]);
                break;
                
            
            case 'juridico':
                $form=Form::create(['thread_id'=>$thread->id,
                                    'name_form_id'=>2
                                    ]);
                
                break;
                
            case 'resolucion':
                $form=Form::create(['thread_id'=>$thread->id,
                                    'name_form_id'=>3
                                    ]);
                
                break;
            
            case 'oficio':
                $form=Form::create(['thread_id'=>$thread->id,
                                    'name_form_id'=>4
                                    ]);
                
                break;
                
            case 'factura':
                $form=Form::create(['thread_id'=>$thread->id,
                                    'name_form_id'=>5
                                    ]);
                break;
            
        }
      
        //create relationship of form-fields

        foreach($fields as $field){
           FormField::create(['form_id'=>$form->id, 
                              'field_id'=> $field['id'],
                              'data'=> $field['data']
                                ]);
        }
        
        //load file of thread 
        if(isset($request->files)){
             $path = public_path().'/docs/thread/'.$thread->id.'/';
             $files = $request->file('files');
             foreach ($files as $file) {
                  $fileName = $file->getClientOriginalName();
                  $ruta='docs/thread/'.$thread->id.'/'.$fileName;
                  Files::create(['url'=>$ruta,
                                'thread_id'=>$thread->id,
                                'name'=>$fileName
                                
                                ]);
                  \Storage::disk('local')->put($ruta,  \File::get($file));
             }
            
        }
        
        $user=User::resolveId();
        $user=User::find($user);
        $message= $user->name."  agregó un formulario de ".$type;
        
        Tracking::create(['tickets_id'=>$thread->tickets_id,
                          'message'=>$message,
                          'users_id'=>$user->id,
                          'verb_id'=> 5
                        ]);
        
        
        
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
        $thread=Thread::find($id);
        return response()->json($thread);
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
       $thread=Thread::find($id);
       $thread->fill($request->all());
       $thread->save();
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
        $thread=Thread::find($id);
        $thread->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
