<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use DateTime;
use Carbon\Carbon;
use App\TicketSubject;
use App\Files;
use JWTAuth;
use App\User;
use App\TicketAssignedUser;
use App\Tracking;
use App\UsersInvolvedTicket;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all tickets on the system
        $ticket=Ticket::with('subjects', 'status', 'ticketsAssignedUserBy', 'ticketsAssignedUserTo', 'person')->paginate(15);
        return response($ticket);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //get date now
        $hoy = Carbon::now();
        $fecha = $hoy->format('Y-m-d');
        
        //select last ticket on this day
        $last_ticket=Ticket::whereDate('created_at', $fecha)
                            ->orderBy('created_at', 'desc')
                            ->limit(1)
                            ->get();
        
        //all insert fields to db.tickets 
        $input=$request->all();
        //validation of settled ticket, if is first on this day, else count settled for each new ticket
        if(count($last_ticket)==0){
            $last_settled=$fecha[2].$fecha[3].$fecha[5].$fecha[6].$fecha[8].$fecha[9].'001';
        }else{
            $last_settled=$last_ticket[0]->settled+1;
        }
        
        //load settled at new element, and create ticket
        $input['settled']=$last_settled;
        
        
        //create ticket
        $ticket=Ticket::create($input);
        
        //validation of subjects, insert into relationship, for each subject
        if(isset($request->subjects_ids)){
            $subjects=$request->subjects_ids;
            for($i=0;$i<count($subjects);$i++){
                TicketSubject::create(['tickets_id'=>$ticket->id, 'subject_id'=>$subjects[$i]]);
            }
        }
        //validation of files, and upload to server whit ticket_id on public directory
        if(isset($request->files)){
             $path = public_path().'/docs/tickets/'.$ticket->id.'/';
             $files = $request->file('files');
             foreach ($files as $file) {
                  $fileName = $file->getClientOriginalName();
                  $ruta='docs/tickets/'.$ticket->id.'/'.$fileName;
                  Files::create(['url'=>$ruta,
                                'tickets_id'=>$ticket->id,
                                'name'=>$fileName
                                
                                ]);
                  \Storage::disk('local')->put($ruta,  \File::get($file));
             }
            
        }
        
        //get User_id by toke
        //method resolveId in App\User;
        $user_assigned_by=User::resolveId(); 
        
        //create relationship user involved tickets (assigned user by)
        UsersInvolvedTicket::create(['users_id'=>$user_assigned_by,
                                    'tickets_id'=>$ticket->id
                                    ]);
        
        //validate if ticket assigned to user, and assigned by "who"
        if(isset($request->user_assigned)){
           
            //expiration date, now +15 days
            $dayAfter = (new DateTime($fecha))->modify('+15 days')->format('Y-m-d');
            $input['expiration'] = $dayAfter;
            $ticket->fill(['expiration'=>$dayAfter]);
            $ticket->save();
            //created user assigned
            TicketAssignedUser::create(['assigned_by_id'=>$user_assigned_by,
                                        'assigned_to_id'=>$request->user_assigned,
                                        'tickets_id'=>$ticket->id
                                        ]);
                                        
            //create relationship user involved tickets (assigned user to)          
            UsersInvolvedTicket::create(['users_id'=>$request->user_assigned,
                                         'tickets_id'=>$ticket->id
                                        ]);
            
        }
        
        
        
        //create tracking to ticket
        $user=User::resolveId();
        $user=User::find($user);
        $message= $user->name." creó el ticket";
        
        Tracking::create(['tickets_id'=>$ticket->id,
                          'message'=>$message,
                          'users_id'=>$user->id,
                          'verb_id'=> 1
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
    {   //get ticket by id
        $ticket=Ticket::with('subjects', 'status', 'ticketsAssignedUserBy', 'ticketsAssignedUserTo', 'person', 'priority', 'files')->find($id);
        return response()->json($ticket);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  //udate a ticket 
       $ticket=Ticket::find($id);
       $ticket->fill($request->all());
       $ticket->save();
       return response(['mensaje'=>'Actualizado Correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   // "deleted" ticket
        $ticket=Ticket::find($id);
        $ticket->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    public function dashboard(){
        //get day now 
        $hoy = Carbon::now();
        $allMonth=Ticket::whereMonth('created_at',$hoy->month)
                      ->whereYear('created_at', $hoy->year)
                      ->count();
        //get tickets by status
        $open=Ticket::where('status_id', '=', 1)->count();
        $assigned=Ticket::where('status_id', '=', 2)->count();
        $process=Ticket::where('status_id', '=', 3)->count();
        $solved=Ticket::where('status_id', '=', 4)->count();
        $close=Ticket::where('status_id', '=', 5)->count();
        
        //data to response for web service
        $data=[ 'allmonth'=>$allMonth,
                'open'=>$open,
                'assigned'=>$assigned,
                'process'=>$process,
                'solved'=>$solved,
                'close'=>$close
                ];
                              
        return response($data);
    }
    
    public function myDashboard(){
        //get day now 
        $user=User::resolveId();
        $hoy = Carbon::now();
        $allMonth=Ticket::whereMonth('created_at',$hoy->month)
                      ->whereYear('created_at', $hoy->year)
                      ->count();
        
        //get tickets by status
        $open=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                     ->join('users', 'users.id', '=', 'assigned_to_id')
                     ->where('users.id', '=', $user)
                     ->where('status_id', '=', 1)
                     ->count();
                      
        $assigned=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                        ->join('users', 'users.id', '=', 'assigned_to_id')
                        ->where('users.id', '=', $user)
                        ->where('status_id', '=', 2)
                        ->count();
                        
        $process=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                        ->join('users', 'users.id', '=', 'assigned_to_id')
                        ->where('users.id', '=', $user)
                        ->where('status_id', '=', 3)
                        ->count();
                        
        $solved=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                      ->join('users', 'users.id', '=', 'assigned_to_id')
                      ->where('users.id', '=', $user)
                      ->where('status_id', '=', 4)
                      ->count();
                      
        $close=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                     ->join('users', 'users.id', '=', 'assigned_to_id')
                     ->where('users.id', '=', $user)
                     ->where('status_id', '=', 5)
                     ->count();
        
        //data to response for web service
        $data=[ 'allmonth'=>$allMonth,
                'open'=>$open,
                'assigned'=>$assigned,
                'process'=>$process,
                'solved'=>$solved,
                'close'=>$close
                ];
                              
        return response($data);
    }
    
    public function ticketByUser(){
        //get id user by token in header request
        $user=User::resolveId();
        
        //get tickets assigned to users
        $ticket=Ticket::join('tickets_assigned_users', 'tickets.id', '=', 'tickets_id' )
                      ->join('users', 'users.id', '=', 'assigned_to_id')
                      ->where('users.id', '=', $user)
                      ->select('tickets.*')
                      ->with('subjects', 'status', 'ticketsAssignedUserBy', 'ticketsAssignedUserTo', 'person')
                      ->paginate(15);
                      
        return response($ticket);
    }
    
    public function ticketExpired(){
        $hoy = Carbon::now();
        
        //get all tickets "hot" or expired
        $ticket=Ticket::whereDate('expiration', '<=', $hoy)
                      ->with('subjects', 'status', 'ticketsAssignedUserBy', 'ticketsAssignedUserTo', 'person')
                      ->paginate(15);
        
        return response($ticket);
        
    } 
    
    public function ticketByStatus($id){
        $ticket=Ticket::where('status_id', '=', $id)
                      ->with('subjects', 'status', 'ticketsAssignedUserBy', 'ticketsAssignedUserTo', 'person')
                      ->paginate(15);
        
        return response($ticket);
    }
    
    public function ticketByFilters(Request $request){
        
        $subjects='';
        $users_involved='';
        //convert array to string, whit comman separated (using find in set procedure in bd)
        if(count($request->subjects)){
            for($i=0; $i<$request->subject; $i++){
                $subjects=$subjects.$request->subject[$i]['id'];
                if($i+1<count($request->subject)){
  	               $subjects=$subjects.",";
  	            }
            }
        }
        
        if(count($request->users_involved_tickets)){
            for($i=0; $i<$request->users_involved_tickets; $i++){
                $users_involved=$users_involved.$request->users_involved_tickets[$i]['id'];
                if($i+1<count($request->users_involved_tickets)){
  	               $users_involved=$users_involved.",";
  	            }
            }
        }
      
        // get vars to request as filters 
        $status_id=$request->status_id;    
        $created_at=$request->created_at;    
        $dateIni=$request->dateIni;   
        $dateEnd=$request->dateEnd;    
        $user_assigned=$request->user_assigned;    
        $expiration=$request->expiration;    
        
        //call to procedure on bd, this return values according by filters 
        $ticket=DB::select('Call searchByFilters(?, ?, ?, ?, ?, ?, ?, ?)', array($status_id, $subjects, $created_at, $users_involved, $dateIni, $dateEnd, $user_assigned, $expiration));
        //Object to parameter "page" on url
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //convert tickets to collection
        $collection = new Collection($ticket);
        //max tickets of page
        $perPage = 15;
        //create pagination 
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));
        
        return response($paginatedSearchResults);
    }
    
    public function myTicketsByFilters(Request $request){
        
        $user_id=User::resolveId();
        $roles_id = $request->roles_id;
        $user_assigned_by = $request->user_assigned_by;
        $month = $request->month;
        $year = '';
        if(isset($request->month)){
            $hoy = Carbon::now();
            $year = $hoy->year;
        }
        //call to procedure on bd, this return values according by filters 
        $ticket=DB::select('Call myTicketsByFilters(?, ?, ?, ?, ?)', array($roles_id, $user_id, $month, $year, $user_assigned_by));
        //Object to parameter "page" on url
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //convert tickets to collection
        $collection = new Collection($ticket);
        //max tickets of page
        $perPage = 15;
        //create pagination 
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));
        
        return response($paginatedSearchResults);
    }
    
    public function ticketReasinged(Request $request){
        
        //get day
        $hoy = Carbon::now();
        //conver to format yyyy/mm/dd
        $fecha = $hoy->format('Y-m-d');
        //select ticket by id
        $ticket=Ticket::find($request->tickets_id);
        //add 15 days to var $fecha
        $dayAfter = (new DateTime($fecha))->modify('+15 days')->format('Y-m-d');
        //get id user assigned by
        $user_assigned_by=User::resolveId(); 
        //refresh object 
        $ticket->fill(['expiration'=>$dayAfter]);
        //save
        $ticket->save();
        //created user assigned
        TicketAssignedUser::create(['assigned_by_id'=>$user_assigned_by,
                                    'assigned_to_id'=>$request->user_assigned,
                                    'tickets_id'=>$ticket->id
                                    ]);
                                    
        //create relationship user involved tickets (assigned user to)          
        UsersInvolvedTicket::create(['users_id'=>$request->user_assigned,
                                     'tickets_id'=>$ticket->id
                                    ]);
        
        return response(['mensaje'=>'Ticket Reasignado']);
    }
    
    public function consolidated(Request $request){
        
        $year = $request->year;
        $user_id = $request->user_id;
        $status_id = $request->status_id;
        $ticket=DB::select('Call consolidated(?, ?, ?)', array($year, $user_id, $status_id));
        return response($ticket);
    }

    public function actuationsTickets(Request $request){
        $status_id = $request->status_id;
        $dateIni = $request->dateIni;
        $dateEnd = $request->dateEnd;
        $subject_id = $request->subject_id;
        $person_id = $request->person_id;
        $users_involved = $request->users_involved;
        
        $ticket=DB::select('Call actuationsTickets(?, ?, ?, ?, ?, ?)', array($status_id, $dateIni, $dateEnd, $subject_id, $person_id, $users_involved ));
        return response($ticket);
        
    }
    
    public function actuationsGeneral(Request $request){
        $dateIni = $request->dateIni;
        $dateEnd = $request->dateEnd;
        $users_involved = $request->users_involved;
        
        $ticket=DB::select('Call actuationsGeneral(?, ?, ?)', array( $users_involved, $dateIni, $dateEnd ));
        return response($ticket);
    }
    
    public function ticketNoAssigned(){
        
    }
    
   
    
}
