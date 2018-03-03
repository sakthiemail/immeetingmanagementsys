<?php
/**
 * Created by PhpStorm.
 * User: Sakthi
 * Date: 2/28/2018
 * Time: 8:13 PM
 */

Auth::routes();
//Route::resource('imevents', 'ImEventsController');
Route::get('calendar/events',['middleware' => 'web','uses'=>'ImEventsController@index']);
Route::get('calendar/event/add',['middleware' => 'web','uses'=>'ImEventsController@create']);
Route::post('calendar/event/store',['middleware' => 'web','uses'=>'ImEventsController@store']);
Route::get('calendar/event/{id}/view',['middleware' => 'web','uses'=>'ImEventsController@show']);
Route::get('calendar/event/edit/{id}',['middleware' => 'web','uses'=>'ImEventsController@edit']);
Route::post('calendar/event/update/{id}',['middleware' => 'web','uses'=>'ImEventsController@update']);
Route::delete('calendar/event/delete/{id}',['middleware' => 'web','uses'=>'ImEventsController@destroy']);
Route::get('calendar/events/calendar-view', ['middleware' => 'web','uses'=>'ImEventsController@calenderView']);
