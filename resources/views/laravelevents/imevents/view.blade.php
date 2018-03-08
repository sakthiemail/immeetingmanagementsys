@extends('layouts.app')

@section('title', '| {{ $imevent->subject}}')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> {{ $imevent->subject}}</h1>
    <hr>
 <div>
   {{ $imevent->description }}
 </div>
  <hr>
  @php
  $useronly=false;
  $url='';
  $button_lbl='';
  if(Auth::user()->id != $imevent->user_id){
  $url='calendar/event/'.$imevent->id.'/accept-status';
  $button_lbl='Submit';
  $useronly=true;
  }
  else
  {
  $url='calendar/event/'.$imevent->id.'/cancel';
  $button_lbl='Cancel this Event';
  }
  @endphp
  {{ Form::open(array('url' => $url )) }}
  @php
  if($useronly){
  @endphp
  <div class="form-group">
        {{ Form::label('message', 'Message') }}
        {{ Form::textarea('message', '', array('class' => 'form-control')) }}
  </div>
   <div class="form-group">
       {{ Form::label('accept_status_label', 'Accepted Or Declained') }}
       <br/>
       {{ Form::label('accept_status', 'Accept') }}
       {{ Form::radio('accept_status', '1' , true) }}
       {{ Form::label('accept_status', 'Declain') }}
       {{ Form::radio('accept_status', '2' , false) }}
   </div>
   @php
    }else{
   @endphp
   <div class="form-group">
       <div class="form-group">
           {{ Form::label('message', 'Message') }}
           {{ Form::textarea('message', '', array('class' => 'form-control')) }}
       </div>
   </div>
   @php
   }
   @endphp
    {{ Form::submit($button_lbl, array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@endsection
