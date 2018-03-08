<?php

namespace Laravelevents\ImEvents\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laravelevents\ImEvents\Models\ImEvents as ImEvents;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Notifications\ImeventNotified;
use Validator;
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
      $invitee=Invitee::where('user_id', Auth::user()->id)->where('imevent_id',$id)->get()->first();
      //dd($invitee->accept_status);
      if($invitee->count() == null) {
          return view('imevents::imevents.401');
      }elseif($invitee->accept_status == "Declained"){
          return redirect('calendar/event/'.$id);
      }
      else{
          return view('imevents::imevents.view', compact('imevent'));
      }
    }

    public function show($id)
    {
      $imevent = ImEvents::findOrFail($id);
      return view('imevents::imevents.show', compact('imevent'));
    }

    public function calendarView()
    {
        $events = [];

        $data = ImEvents::all();

        if($data->count()){

            foreach ($data as $key => $value) {

                $events[] = \Calendar::event(

                    $value->subject.", ".$value->location,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date.' +1 day'),
                    $value->id

                );

                $calendar = \Calendar::addEvents($events, [
                ])->setCallbacks([
                    "eventClick" => "function(event, jsEvent, view) {
                        $.ajax({
                        url: 'popupview/'+event.id,
                        id:event.id,
                        token:'".csrf_token()."',
                        type: 'get',
                        dataType:'json',
                        success: function(response){ 
                        $('#event_name').html(response.subject);
                        $('#event_description').html(response.description);
                        $('#event_start_date').html(response.start_date);
                        $('#event_due_date').html(response.due_date);
                        $('#event_status').html(response.status);
                        $('#calendarPopup').modal('show'); 
                        }
                        }); 
                        }"
                ]);

            }

        }

      //  $calendar = \Calendar::addEvents($events);

        return view('imevents::imevents.calendar', compact('calendar'));

    }

    public function popupView($id){
        $imtask = ImEvents::findOrFail($id);
        return json_encode($imtask);
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

        $this->validate($request, [
            'userslist' => 'required',
            'type' => 'required',
            'subject' => 'required|max:255',
            'description' => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'location' => 'required',
        ]);

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
            'user_id'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
            ]);
        //return view('imevents::imevents.index',compact('imevents'));
        return redirect('calendar/events');
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
        $this->validate($request, [
            'userslist' => 'required',
            'subject' => 'required|max:255',
            'description' => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'location' => 'required',
        ]);
        $imevent = ImEvents::findOrFail($id);
        $imevent->subject = $request->input('subject');
        $imevent->type = $request->input('type');
        $imevent->description = $request->input('description');
        $imevent->start_date =Carbon::parse($request->input('start_date'));
        $imevent->end_date = Carbon::parse($request->input('end_date'));
        $imevent->location = $request->input('location');
        $imevent->billable = ($request->input('billable'))?'1':'0';
        $imevent->status  = $request->input('status');
        $imevent->save();
        return redirect('calendar/events');
    }

    public function destroy($id)
    {

    }
    public function cancelEvent(Request $request, $id)
    {
        $imevent = ImEvents::findOrFail($id);
        $imevent->reason = $request->input('message');
        $imevent->status  = 2;
        $imevent->save();
        return redirect('calendar/events');
    }
}
