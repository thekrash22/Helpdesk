<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'cors'],function(){
    
    Route::post('auth', 'UserController@auth');
    Route::group(['middleware'=> 'jwt.auth'], function () {

        Route::resource('action', 'ActionController');
        Route::resource('dni', 'DNITypeController');//
        Route::resource('nameForm', 'NameFormController');//
        Route::resource('status', 'StatusController');
        Route::resource('priority', 'PriorityController');//
        Route::resource('type', 'TypeController');//
        Route::resource('notification', 'NotificationController');
        Route::resource('verb', 'VerbController');//
        Route::get('ticketsAll', 'TicketController@ticketsAll');
        Route::post('updateSubjects','TicketController@updateSubjects');
        Route::post('avatar', 'UserController@avatar');
        
        Route::get('area', ['middleware'=>['ability:readlist-area'],'uses'=>'AreaController@index']);
        Route::get('area/{area}', ['middleware'=>['ability:read-area'],'uses'=>'AreaController@show']);
        Route::delete('area/{area}', ['middleware'=>['ability:delete-area'],'uses'=>'AreaController@destroy']);
        Route::put('area/{area}', ['middleware'=>['ability:update-area'],'uses'=>'AreaController@update']);
        Route::post('area', ['middleware'=>['ability:create-area'],'uses'=>'AreaController@store']);
        
        Route::get('subject', ['middleware'=>['ability:readlist-subject'],'uses'=>'SubjectController@index']);
        Route::get('subject/{subject}', ['middleware'=>['ability:read-subject'],'uses'=>'SubjectController@show']);
        Route::delete('subject/{subject}', ['middleware'=>['ability:delete-subject'],'uses'=>'SubjectController@destroy']);
        Route::put('subject/{subject}', ['middleware'=>['ability:update-subject'],'uses'=>'SubjectController@update']);
        Route::post('subject', ['middleware'=>['ability:create-subject'],'uses'=>'SubjectController@store']);
        
        Route::get('field', ['middleware'=>['ability:readlist-field'],'uses'=>'FieldController@index']);
        Route::get('field/{field}', ['middleware'=>['ability:read-field'],'uses'=>'FieldController@show']);
        Route::delete('field/{field}', ['middleware'=>['ability:delete-field'],'uses'=>'FieldController@destroy']);
        Route::put('field/{field}', ['middleware'=>['ability:update-field'],'uses'=>'FieldController@update']);
        Route::post('field', ['middleware'=>['ability:create-field'],'uses'=>'FieldController@store']);
        
        Route::get('form', ['middleware'=>['ability:readlist-form'],'uses'=>'FormController@index']);
        Route::get('form/{form}', ['middleware'=>['ability:read-form'],'uses'=>'FormController@show']);
        Route::delete('form/{form}', ['middleware'=>['ability:delete-form'],'uses'=>'FormController@destroy']);
        Route::put('form/{form}', ['middleware'=>['ability:update-form'],'uses'=>'FormController@update']);
        Route::post('form', ['middleware'=>['ability:create-form'],'uses'=>'FormController@store']);
        
        Route::get('formField', ['middleware'=>['ability:readlist-form'],'uses'=>'FormFieldController@index']);
        Route::get('formField/{formField}', ['middleware'=>['ability:read-form'],'uses'=>'FormFieldController@show']);
        Route::delete('formField/{formField}', ['middleware'=>['ability:delete-form'],'uses'=>'FormFieldController@destroy']);
        Route::put('formField/{formField}', ['middleware'=>['ability:update-form'],'uses'=>'FormFieldController@update']);
        Route::post('formField', ['middleware'=>['ability:create-form'],'uses'=>'FormFieldController@store']);
    
        Route::get('person', ['middleware'=>['ability:readlist-person'],'uses'=>'PersonController@index']);
        Route::get('personAll', ['middleware'=>['ability:readlist-person'],'uses'=>'PersonController@all']);
        Route::get('person/{person}', ['middleware'=>['ability:read-person'],'uses'=>'PersonController@show']);
        Route::delete('person/{person}', ['middleware'=>['ability:delete-person'],'uses'=>'PersonController@destroy']);
        Route::put('person/{person}', ['middleware'=>['ability:update-person'],'uses'=>'PersonController@update']);
        Route::post('person', ['middleware'=>['ability:create-person'],'uses'=>'PersonController@store']);
        
        Route::get('thread', ['middleware'=>['ability:readlist-thread'],'uses'=>'ThreadController@index']);
        Route::get('thread/{thread}', ['middleware'=>['ability:read-thread'],'uses'=>'ThreadController@show']);
        Route::delete('thread/{thread}', ['middleware'=>['ability:delete-thread'],'uses'=>'ThreadController@destroy']);
        Route::put('thread/{thread}', ['middleware'=>['ability:update-thread'],'uses'=>'ThreadController@update']);
        Route::post('thread', ['middleware'=>['ability:create-thread'],'uses'=>'ThreadController@store']);
        
        Route::get('ticketAssigned', ['middleware'=>['ability:readlist_tickets_assigned'],'uses'=>'TicketAssignedController@index']);
        Route::get('ticketAssigned/{ticketAssigned}', ['middleware'=>['ability:read_tickets_assigned'],'uses'=>'TicketAssignedController@show']);
        Route::delete('ticketAssigned/{ticketAssigned}', ['middleware'=>['ability:delete_tickets_assigned'],'uses'=>'TicketAssignedController@destroy']);
        Route::put('ticketAssigned/{ticketAssigned}', ['middleware'=>['ability:update_tickets_assigned'],'uses'=>'TicketAssignedController@update']);
        Route::post('ticketAssigned', ['middleware'=>['ability:create_tickets_assigned'],'uses'=>'TicketAssignedController@store']);
        
        Route::get('ticket', ['middleware'=>['ability:readlist-tickets'],'uses'=>'TicketController@index']);
        Route::get('ticket/{ticket}', ['middleware'=>['ability:read-tickets'],'uses'=>'TicketController@show']);
        Route::delete('ticket/{ticket}', ['middleware'=>['ability:delete-tickets'],'uses'=>'TicketController@destroy']);
        Route::put('ticket/{ticket}', ['middleware'=>['ability:update-tickets'],'uses'=>'TicketController@update']);
        Route::post('ticket', ['middleware'=>['ability:create-tickets'],'uses'=>'TicketController@store']);
        
        //Route::resource('ticketSubject', 'TicketSubjectController');
        //Route::resource('tracking', 'TrackingController');
        //Route::resource('userInvolved', 'UserInvolvedTicketController');
        
        Route::get('user', ['middleware'=>['ability:readlist-user'],'uses'=>'UserController@index']);
        Route::get('userAll', ['middleware'=>['ability:readlist-user'],'uses'=>'UserController@all']);
        Route::get('user/{user}', ['middleware'=>['ability:read-user'],'uses'=>'UserController@show']);
        Route::delete('user/{user}', ['middleware'=>['ability:delete-user'],'uses'=>'UserController@destroy']);
        Route::put('user/{user}', ['middleware'=>['ability:update-user'],'uses'=>'UserController@update']);
        Route::post('user', ['middleware'=>['ability:create-user'],'uses'=>'UserController@store']);
        
        Route::get('dashboard', ['middleware'=>['ability:get-dashboard'],'uses'=>'TicketController@dashboard']);
        Route::get('ticketByUser', ['middleware'=>['ability:read-tickets'],'uses'=> 'TicketController@ticketByUser']);
        Route::get('ticketExpired', ['middleware'=>['ability:read-tickets'],'uses'=>'TicketController@ticketExpired']);
        Route::get('ticketByStatus/{id}', ['middleware'=>['ability:read-tickets'],'uses'=>'TicketController@ticketByStatus']);
        Route::get('personSearch/{type}/{dni}', ['middleware'=>['ability:readlist-tickets'],'uses'=>'PersonController@searchByDNI']);
        Route::get('myDashboard', ['middleware'=>['ability:read-dashboard-funcionario'],'uses'=>'TicketController@myDashboard']);
        Route::get('fieldByName/{id}', ['middleware'=>['ability:read-field'],'uses'=>'FieldController@fieldByName']);
       
        Route::post('ticketByFilters', 'TicketController@ticketByFilters');
        Route::post('myTicketsByFilters', 'TicketController@myTicketsByFilters');
        Route::post('myTicketsAll', 'TicketController@myTicketsAll');
        Route::post('ticketReasinged', 'TicketController@ticketReasinged');
        Route::post('consolidated', ['middleware'=>['ability:all-consolidado'],'uses'=>'TicketController@consolidated']);
        Route::post('actuationsTickets', ['middleware'=>['ability:actuations-tickets'],'uses'=>'TicketController@actuationsTickets']);
        Route::post('actuationsGeneral', ['middleware'=>['ability:actuations-general'],'uses'=>'TicketController@actuationsGeneral']);
        
        
       
    });
    
});