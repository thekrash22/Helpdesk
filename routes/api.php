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
    
    Route::resource('action', 'ActionController');
    Route::resource('area', 'AreaController');
    Route::resource('dni', 'DNITypeController');
    Route::resource('nameForm', 'NameFormController');
    Route::resource('status', 'StatusController');
    Route::resource('subject', 'SubjectController');
    Route::resource('priority', 'PriorityController');
    Route::resource('type', 'TypeController');
    Route::resource('field', 'FieldController');
    Route::resource('form', 'FormController');
    Route::resource('formField', 'FormController');
    Route::resource('notification', 'NotificationController');
    Route::resource('person', 'PersonController');
    Route::resource('thread', 'ThreadController');
    Route::resource('ticketAssigned', 'TicketAssignedController');
    Route::resource('ticket', 'TicketController');
    Route::resource('ticketSubject', 'TicketSubjectController');
    Route::resource('tracking', 'TrackingController');
    Route::resource('userInvolved', 'UserInvolvedTicketController');
    Route::resource('verb', 'VerbController');
    Route::resource('user', 'UserController');
    
    
    Route::get('dashboard', 'TicketController@dashboard');
    Route::get('ticketByUser', 'TicketController@ticketByUser');
    Route::get('ticketExpired', 'TicketController@ticketExpired');
    Route::get('ticketByStatus/{id}', 'TicketController@ticketByStatus');
   
    Route::post('ticketByFilters', 'TicketController@ticketByFilters');
    Route::post('myTicketsByFilters', 'TicketController@myTicketsByFilters');
    Route::post('ticketReasinged', 'TicketController@ticketReasinged');
    Route::post('consolidated', 'TicketController@consolidated');
    Route::post('actuationsTickets', 'TicketController@actuationsTickets');
    Route::post('actuationsGeneral', 'TicketController@actuationsGeneral');
    
});