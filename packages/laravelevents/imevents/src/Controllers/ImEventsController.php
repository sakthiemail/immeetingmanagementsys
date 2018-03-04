<?php

namespace Laravelevents\ImEvents\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laravelevents\ImEvents\Models\ImEvents as ImEvents;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Notifications\ImeventNotified;
use Auth;
use Session;
use Calendar;

class ImEventsController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('calenderView');
    }

    public function view($id)
    {
      $imevent = ImEvents::findOrFail($id);
      return view('imevents::imevents.view', compact('imevent'));
    }

    public function show($id)
    {
      $imevent = ImEvents::findOrFail($id);
      return view('imevents::imevents.show', compact('imevent'));
    }

    public function calenderView()
    {
        $events = [];

        $data = ImEvents::all();

        if($data->count()){

            foreach ($data as $key => $value) {

                $events[] = \Calendar::event(

                    $value->subject.", ".$value->location,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date.' +1 day')

                );

            }

        }

        $calendar = \Calendar::addEvents($events);

        return view('imevents::imevents.calendar', compact('calendar'));

    }

    public function index()
    {
        $imevents = ImEvents::All();
        return view('imevents::imevents.index', compact('imevents'));
    }

    public function create()
    {
        $users = User::pluck('name', 'id');
        $users->prepend('-- Select --', 0);
        return view('imevents::imevents.create',compact('users'));
    }

    public function store(Request $request)
    {
        $userslist = $request->get('userslist');
        //dd($userslist);
        $imevent = ImEvents::create([
            'type'=>$request->input('type'),
            'subject'=>$request->input('subject'),
            'description'=>$request->input('description'),
            'start_date'=>Carbon::parse($request->input('start_date')),
            'end_date'=>Carbon::parse($request->input('end_date')),
            'location'=>$request->input('location'),
            'billable'=>($request->input('billable'))?'1':'0',
            'status' => 1,
            'remainder_interval'=>$request->input('remainder_interval'),
            'user_id'=>Auth::user()->id
            ]);
        foreach($userslist as $uid) {
           Invitee::create([
                'user_id'=> $uid,
                'imevent_id'=> $imevent->id,
            ]);
        }
        $users=User::find($userslist);
        \Notification::send($users, new ImeventNotified($imevent));
        $imevents = ImEvents::All();
        return view('imevents::imevents.index',compact('imevents'));
    }

    public function edit($id)
    {
        $users = User::pluck('name', 'id');
        $imevent = ImEvents::findOrFail($id);
        //dd($imevent);
        $oldusers=array();
        foreach( $imevent->invitees as $invitee){
          $oldusers[] = $invitee->user->id;
        }
        return view('imevents::imevents.edit', compact('imevent','users','oldusers'));
    }

    public function update(Request $request, $id)
    {
        $userslist=array();
        $imevent = ImEvents::findOrFail($id);
        $imevent->subject = $request->input('subject');
        $imevent->type = $request->input('type');
        $imevent->description = $request->input('description');
        $imevent->start_date =Carbon::parse($request->input('start_date'));
        $imevent->end_date = Carbon::parse($request->input('end_date'));
        $imevent->location = $request->input('location');
        $imevent->billable = ($request->input('billable'))?'1':'0';
        $imevent->status  = $request->input('status');
        $imevent->remainder_interval = $request->input('remainder_interval');
        $imevent->save();
        $imevents = ImEvents::All();
        foreach($imevent->invitees as $invitee)
        {
        $userslist[] = $invitee->user->id;
        }
        $users=User::find($userslist);
        \Notification::send($users, new ImeventNotified($imevent));
        return view('imevents::imevents.index',compact('imevents'));
    }

    public function destroy($id)
    {

    }
    public function cancelEvent(Request $request, $id)
    {
      
    }
}
