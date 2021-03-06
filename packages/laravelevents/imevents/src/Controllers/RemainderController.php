<?php

namespace Laravelevents\ImEvents\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\ImEvents as ImEvents;
use Illuminate\Http\Request;
use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Notifications\InviteeNotified;
use Auth;
use Session;
use Calendar;

class RemainderController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'clearance']);
    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    public function getAllEvents()
    {

            $imeventids =  Invitee::select('imevent_id')->where('user_id', Auth::user()->id)->pluck('imevent_id')->toArray();
            $imevents = ImEvents::whereIn('id',$imeventids)->get();
            //dd($imevents);
    }
}
